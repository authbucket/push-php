<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Controller;

use AuthBucket\Push\Exception\InvalidRequestException;
use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use AuthBucket\Push\Validator\Constraints\DeviceId;
use AuthBucket\Push\Validator\Constraints\ServiceType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Push device endpoint controller implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class DeviceController
{
    protected $securityContext;
    protected $validator;
    protected $modelManagerFactory;

    public function __construct(
        SecurityContextInterface $securityContext,
        ValidatorInterface $validator,
        ModelManagerFactoryInterface $modelManagerFactory
    )
    {
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->modelManagerFactory = $modelManagerFactory;
    }

    public function deviceAction(Request $request)
    {
        $clientId = $this->checkClientId();

        $username = $this->checkUsername();

        $deviceId = $this->checkDeviceId($request);

        $serviceType = $this->checkServiceType($request);

        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $class = $deviceManager->getClassName();
        $device = new $class();
        $device->setDeviceId($deviceId)
            ->setServiceType($serviceType)
            ->setClientId($clientId)
            ->setUsername($username)
            ->setExpires(new \DateTime('+7 days'));
        $device = $deviceManager->createModel($device);

        $parameters = array(
            'device_id' => $device->getDeviceId(),
            'service_type' => $device->getServiceType(),
            'client_id' => $device->getClientId(),
            'username' => $device->getUsername(),
            'expires_in' => $device->getExpires()->getTimestamp() - time(),
        );

        return JsonResponse::create($parameters, 200, array(
            'Cache-Control' => 'no-store',
            'Pragma' => 'no-cache',
        ));
    }

    private function checkClientId()
    {
        // Fetch client_id from securityContext.
        return '';
    }

    private function checkUsername()
    {
        // Fetch username from securityContext.
        return '';
    }

    private function checkDeviceId(Request $request)
    {
        // Fetch device_id from POST
        $deviceId = $request->request->get('device_id');
        $errors = $this->validator->validateValue($deviceId, array(
            new NotBlank(),
            new DeviceId(),
        ));
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $deviceId;
    }

    private function checkServiceType(Request $request)
    {
        // Fetch service_type from POST
        $serviceType = $request->request->get('service_type');
        $errors = $this->validator->validateValue($serviceType, array(
            new NotBlank(),
            new ServiceType(),
        ));
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $serviceType;
    }
}
