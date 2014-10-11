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

use AuthBucket\Push\Exception\InvalidRequestException;
use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use AuthBucket\Push\ServiceType\ServiceTypeHandlerFactoryInterface;
use AuthBucket\Push\Validator\Constraints\ServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    protected $validator;
    protected $serializer;
    protected $modelManagerFactory;
    protected $serviceTypeHandlerFactory;

    public function __construct(
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        ModelManagerFactoryInterface $modelManagerFactory,
        ServiceTypeHandlerFactoryInterface $serviceTypeHandlerFactory
    ) {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->modelManagerFactory = $modelManagerFactory;
        $this->serviceTypeHandlerFactory = $serviceTypeHandlerFactory;
    }

    public function registerAction(Request $request)
    {
        $format = $request->getRequestFormat();

        $deviceSupplied = $this->checkDevice($request);

        // Remove all legacy record for this deviceToken.
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'deviceToken' => $deviceSupplied->getDeviceToken(),
            'serviceId' => $deviceSupplied->getServiceId(),
        ));
        foreach ($devices as $device) {
            $deviceManager->deleteModel($device);
        }

        // Recreate record with new supplied values.
        $deviceSaved = $deviceManager->createModel($deviceSupplied);

        return new Response($this->serializer->serialize($deviceSaved, $format), 200, array(
            "Content-Type" => $request->getMimeType($format),
        ));
    }

    public function unregisterAction(Request $request)
    {
        $format = $request->getRequestFormat();

        $deviceSupplied = $this->checkDevice($request);

        // Remove all legacy record for this deviceToken.
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'deviceToken' => $deviceSupplied->getDeviceToken(),
            'serviceId' => $deviceSupplied->getServiceId(),
        ));
        foreach ($devices as $device) {
            $deviceManager->deleteModel($device);
        }

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

    protected function checkDevice(Request $request)
    {
        // Fetch device from request body.
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $device = $this->serializer->deserialize(
            $request->getContent(),
            $deviceManager->getClassName(),
            $request->getRequestFormat()
        );

        // Validate supplied values.
        $errors = $this->validator->validate($device);
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        // Check if provided serviceId exists.
        $serviceManager = $this->modelManagerFactory->getModelManager('service');
        $service = $serviceManager->readModelOneBy(array(
            'serviceId' => $device->getServiceId(),
        ));
        if ($service === null) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $device;
    }

    protected function checkServiceType(Request $request)
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
