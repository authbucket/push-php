<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Controller;

use AuthBucket\OAuth2\Security\Authentication\Token\AccessTokenToken;
use AuthBucket\Push\Exception\InvalidRequestException;
use AuthBucket\Push\Exception\ServerErrorException;
use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use AuthBucket\Push\ServiceType\ServiceTypeHandlerFactoryInterface;
use AuthBucket\Push\Validator\Constraints\DeviceToken;
use AuthBucket\Push\Validator\Constraints\ServiceId;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Push device endpoint controller implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class PushController
{
    protected $tokenStorage;
    protected $validator;
    protected $modelManagerFactory;
    protected $serviceTypeHandlerFactory;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        ValidatorInterface $validator,
        ModelManagerFactoryInterface $modelManagerFactory,
        ServiceTypeHandlerFactoryInterface $serviceTypeHandlerFactory
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->validator = $validator;
        $this->modelManagerFactory = $modelManagerFactory;
        $this->serviceTypeHandlerFactory = $serviceTypeHandlerFactory;
    }

    public function registerAction(Request $request)
    {
        $clientId = $this->checkClientId();

        $serviceId = $this->checkServiceId($request, $clientId);

        $deviceToken = $this->checkDeviceToken($request);

        $username = $this->checkUsername();

        $scope = $this->checkScope();

        // Remove all legacy record for this device_token.
        $this->deleteDeviceToken($deviceToken, $serviceId, $username);

        // Recreate record with new supplied values.
        $parameters = $this->createDeviceToken($deviceToken, $serviceId, $username, $scope);

        return JsonResponse::create($parameters, 200, [
            'Cache-Control' => 'no-store',
            'Pragma' => 'no-cache',
        ]);
    }

    public function unregisterAction(Request $request)
    {
        $clientId = $this->checkClientId();

        $serviceId = $this->checkServiceId($request, $clientId);

        $deviceToken = $this->checkDeviceToken($request);

        $username = $this->checkUsername();

        // Remove all legacy record for this device_token.
        $parameters = $this->deleteDeviceToken($deviceToken, $serviceId, $username);

        return JsonResponse::create($parameters, 200, [
            'Cache-Control' => 'no-store',
            'Pragma' => 'no-cache',
        ]);
    }

    public function sendAction(Request $request)
    {
        $clientId = $this->checkClientId();

        $username = $this->checkUsername();

        $scope = $this->checkScope();

        $payload = $this->checkPayload($request);

        // Save the raw message.
        $messageManager = $this->modelManagerFactory->getModelManager('message');
        $class = $messageManager->getClassName();
        $message = new $class();
        $message->setMessageId(md5(uniqid(null, true)))
            ->setClientId($clientId)
            ->setUsername($username)
            ->setScope($scope)
            ->setPayload($payload);
        $message = $messageManager->createModel($message);

        // Send out message per service_id.
        $serviceManager = $this->modelManagerFactory->getModelManager('service');
        $services = $serviceManager->readModelBy([
            'clientId' => $clientId,
        ]);
        foreach ($services as $service) {
            $this->serviceTypeHandlerFactory
                ->getServiceTypeHandler($service->getServiceType())
                ->send($service, $message);
        }

        // Prepare parameters for JSON response.
        $parameters = [
            'message_id' => $message->getMessageId(),
            'client_id' => $message->getClientId(),
            'username' => $message->getUsername(),
            'scope' => implode(' ', (array) $message->getScope()),
            'payload' => $message->getPayload(),
        ];

        return JsonResponse::create($parameters, 200, [
            'Cache-Control' => 'no-store',
            'Pragma' => 'no-cache',
        ]);
    }

    protected function checkClientId()
    {
        $token = $this->tokenStorage->getToken();
        if ($token === null || !$token instanceof AccessTokenToken) {
            throw new ServerErrorException([
                'error_description' => 'The authorization server encountered an unexpected condition that prevented it from fulfilling the request.',
            ]);
        }

        return $token->getClientId();
    }

    protected function checkUsername()
    {
        $token = $this->tokenStorage->getToken();
        if ($token === null || !$token instanceof AccessTokenToken) {
            throw new ServerErrorException([
                'error_description' => 'The authorization server encountered an unexpected condition that prevented it from fulfilling the request.',
            ]);
        }

        return $token->getUsername();
    }

    protected function checkScope()
    {
        $token = $this->tokenStorage->getToken();
        if ($token === null || !$token instanceof AccessTokenToken) {
            throw new ServerErrorException([
                'error_description' => 'The authorization server encountered an unexpected condition that prevented it from fulfilling the request.',
            ]);
        }

        return $token->getScope();
    }

    protected function checkDeviceToken(Request $request)
    {
        // device_token is required and in valid format.
        $deviceToken = $request->request->get('device_token');
        $errors = $this->validator->validate($deviceToken, [
            new NotBlank(),
            new DeviceToken(),
        ]);
        if (count($errors) > 0) {
            throw new InvalidRequestException([
                'error_description' => 'The request includes an invalid parameter value.',
            ]);
        }

        return $deviceToken;
    }

    protected function checkServiceId(Request $request, $clientId)
    {
        // service_id is required and in valid format.
        $serviceId = $request->request->get('service_id');
        $errors = $this->validator->validate($serviceId, [
            new NotBlank(),
            new ServiceId(),
        ]);
        if (count($errors) > 0) {
            throw new InvalidRequestException([
                'error_description' => 'The request includes an invalid parameter value.',
            ]);
        }

        // Check if service_id belongs to corresponding client_id.
        $serviceManager = $this->modelManagerFactory->getModelManager('service');
        $service = $serviceManager->readModelOneBy([
            'clientId' => $clientId,
            'serviceId' => $serviceId,
        ]);
        if ($service === null) {
            throw new InvalidRequestException([
                'error_description' => 'The request includes an invalid parameter value.',
            ]);
        }

        return $serviceId;
    }

    protected function checkPayload(Request $request)
    {
        $payload = $request->request->all();

        return (array) $payload;
    }

    protected function createDeviceToken($deviceToken, $serviceId, $username, $scope)
    {
        // Create the new record.
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $class = $deviceManager->getClassName();
        $device = new $class();
        $device->setDeviceToken($deviceToken)
            ->setServiceId($serviceId)
            ->setUsername($username)
            ->setScope((array) $scope);
        $device = $deviceManager->createModel($device);

        // Prepare parameters for JSON response.
        $parameters = [
            'device_token' => $device->getDeviceToken(),
            'service_id' => $device->getServiceId(),
            'username' => $device->getUsername(),
            'scope' => implode(' ', (array) $device->getScope()),
        ];

        return $parameters;
    }

    protected function deleteDeviceToken($deviceToken, $serviceId, $username)
    {
        // Fetch the legacy records for this device_token.
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy([
            'deviceToken' => $deviceToken,
            'serviceId' => $serviceId,
            'username' => $username,
        ]);

        // Delete the legacy records.
        foreach ($devices as $device) {
            $deviceManager->deleteModel($device);
        }

        // Prepare parameters for JSON response.
        $parameters = [
            'device_token' => $deviceToken,
            'service_id' => $serviceId,
            'username' => $username,
        ];

        return $parameters;
    }
}
