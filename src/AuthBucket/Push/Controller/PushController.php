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
use AuthBucket\Push\Validator\Constraints\VariantType;
use AuthBucket\Push\VariantType\VariantTypeHandlerFactoryInterface;
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
    protected $variantTypeHandlerFactory;

    public function __construct(
        ValidatorInterface $validator,
        SerializerInterface $serializer,
        ModelManagerFactoryInterface $modelManagerFactory,
        VariantTypeHandlerFactoryInterface $variantTypeHandlerFactory
    ) {
        $this->validator = $validator;
        $this->serializer = $serializer;
        $this->modelManagerFactory = $modelManagerFactory;
        $this->variantTypeHandlerFactory = $variantTypeHandlerFactory;
    }

    public function registerAction(Request $request)
    {
        $format = $request->getRequestFormat();

        $deviceSupplied = $this->checkDevice($request);

        // Remove all legacy record for this deviceToken.
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'deviceToken' => $deviceSupplied->getDeviceToken(),
            'variantId' => $deviceSupplied->getVariantId(),
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
            'variantId' => $deviceSupplied->getVariantId(),
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
        foreach ($this->variantTypeHandlerFactory->getVariantTypeHandlers() as $key => $value) {
            $response[$key] = $this->variantTypeHandlerFactory
                ->getVariantTypeHandler($key)
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

        // Check if provided variantId exists.
        $variantManager = $this->modelManagerFactory->getModelManager('variant');
        $variant = $variantManager->readModelOneBy(array(
            'variantId' => $device->getVariantId(),
        ));
        if ($variant === null) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $device;
    }

    protected function checkVariantType(Request $request)
    {
        // Fetch variant_type from POST
        $variantType = $request->request->get('variant_type');
        $errors = $this->validator->validateValue($variantType, array(
            new NotBlank(),
            new VariantType(),
        ));
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $variantType;
    }
}
