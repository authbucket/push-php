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
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Push device endpoint controller implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class PushController
{
    protected $securityContext;
    protected $validator;
    protected $serializer;
    protected $modelManagerFactory;
    protected $serviceTypeHandlerFactory;

    public function __construct(
        SecurityContextInterface $securityContext,
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        ModelManagerFactoryInterface $modelManagerFactory,
        ServiceTypeHandlerFactoryInterface $serviceTypeHandlerFactory
    ) {
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->serializer = $serializer;
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
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'deviceToken' => $deviceToken,
            'serviceId' => $serviceId,
        ));
        foreach ($devices as $device) {
            $deviceManager->deleteModel($device);
        }

        // Recreate record with new supplied values.
        $class = $deviceManager->getClassName();
        $device = new $class();
        $device->setDeviceToken($deviceToken)
            ->setServiceId($serviceId)
            ->setUsername($username)
            ->setScope((array) $scope);
        $device = $deviceManager->createModel($device);

        // Prepare parameters for JSON response.
        $parameters = array(
            'device_token' => $device->getDeviceToken(),
            'service_id' => $device->getServiceId(),
            'username' => $device->getUsername(),
            'scope' => implode(' ', (array) $device->getScope()),
        );

        return JsonResponse::create($parameters, 200, array(
            'Cache-Control' => 'no-store',
            'Pragma' => 'no-cache',
        ));
    }

    public function unregisterAction(Request $request)
    {
        $clientId = $this->checkClientId();

        $deviceToken = $this->checkDeviceToken($request);

        // Remove all legacy record for this deviceToken.
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'deviceToken' => $deviceToken,
            'serviceId' => $serviceId,
        ));
        foreach ($devices as $device) {
            $deviceManager->deleteModel($device);
        }

        $format = $request->getRequestFormat();

        $deviceSupplied = $this->checkDevice($request);

        return new Response($this->serializer->serialize($deviceSupplied, $format), 200, array(
            "Content-Type" => $request->getMimeType($format),
        ));
    }

    public function sendAction(Request $request)
    {
        $response = array();
        foreach ($this->serviceTypeHandlerFactory->getServiceTypeHandlers() as $key => $value) {
            $response[$key] = $this->serviceTypeHandlerFactory
                ->getServiceTypeHandler($key)
                ->send($request);
        }

        return new Response(json_encode($response));
    }

    protected function checkClientId()
    {
        $token = $this->securityContext->getToken();
        if ($token === null || !$token instanceof AccessTokenToken) {
            throw new ServerErrorException(array(
                'error_description' => 'The authorization server encountered an unexpected condition that prevented it from fulfilling the request.',
            ));
        }

        return $token->getClientId();
    }

    protected function checkUsername()
    {
        $token = $this->securityContext->getToken();
        if ($token === null || !$token instanceof AccessTokenToken) {
            throw new ServerErrorException(array(
                'error_description' => 'The authorization server encountered an unexpected condition that prevented it from fulfilling the request.',
            ));
        }

        return $token->getUsername();
    }

    protected function checkScope()
    {
        $token = $this->securityContext->getToken();
        if ($token === null || !$token instanceof AccessTokenToken) {
            throw new ServerErrorException(array(
                'error_description' => 'The authorization server encountered an unexpected condition that prevented it from fulfilling the request.',
            ));
        }

        return $token->getScope();
    }

    protected function checkDeviceToken(Request $request)
    {
        // device_token is required and in valid format.
        $deviceToken = $request->request->get('device_token');
        $errors = $this->validator->validateValue($deviceToken, array(
            new NotBlank(),
            new DeviceToken(),
        ));
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $deviceToken;
    }

    protected function checkServiceId(Request $request, $clientId)
    {
        // service_id is required and in valid format.
        $serviceId = $request->request->get('service_id');
        $errors = $this->validator->validateValue($serviceId, array(
            new NotBlank(),
            new ServiceId(),
        ));
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        // Check if service_id belongs to corresponding client_id.
        $serviceManager = $this->modelManagerFactory->getModelManager('service');
        $service = $serviceManager->readModelOneBy(array(
            'clientId' => $clientId,
            'serviceId' => $serviceId,
        ));
        if ($service === null) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $serviceId;
    }
}
