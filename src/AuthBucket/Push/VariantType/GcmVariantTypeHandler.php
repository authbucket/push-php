<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\VariantType;

use Guzzle\Http\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * GCM variant type handler implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class GcmVariantTypeHandler extends AbstractVariantTypeHandler
{
    public function register(Request $request)
    {
        $applicationId = $this->checkApplicationId();

        $username = $this->checkUsername();

        $deviceToken = $this->checkDeviceToken($request);

        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $class = $deviceManager->getClassName();
        $device = new $class();
        $device->setDeviceToken($deviceToken)
            ->setVariantType('gcm')
            ->setApplicationId($applicationId)
            ->setUsername($username)
            ->setExpires(new \DateTime('+7 days'));
        $device = $deviceManager->createModel($device);

        $parameters = array(
            'device_token' => $device->getDeviceToken(),
            'variant_type' => $device->getVariantType(),
            'application_id' => $device->getApplicationId(),
            'username' => $device->getUsername(),
            'expires_in' => $device->getExpires()->getTimestamp() - time(),
        );

        return JsonResponse::create($parameters, 200, array(
            'Cache-Control' => 'no-store',
            'Pragma' => 'no-cache',
        ));
    }

    public function unregister(Request $request)
    {
        $applicationId = $this->checkApplicationId();

        $username = $this->checkUsername();

        $deviceToken = $this->checkDeviceToken($request);

        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'deviceToken' => $deviceToken,
            'variantType' => 'gcm',
            'applicationId' => $applicationId,
            'username' => $username,
        ));
        foreach ($devices as $device) {
            $deviceManager->deleteModel($device);
        }

        return new Response();
    }

    public function send(Request $request)
    {
        $applicationId = $this->checkApplicationId();

        $username = $this->checkUsername();

        $data = $this->checkData($request);

        $variantManager = $this->modelManagerFactory->getModelManager('variant');
        $variant = $variantManager->readModelOneBy(array(
            'variantType' => 'gcm',
            'applicationId' => $applicationId,
        ));
        $options = $variant->getOptions();

        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'variantType' => 'gcm',
            'applicationId' => $applicationId,
            'username' => $username,
        ));

        $deviceTokens = array();
        foreach ($devices as $device) {
            if ($device->getExpires() > new \DateTime()) {
                $deviceTokens[$device->getDeviceToken()] = $device->getDeviceToken();
            }
        }

        $response = array();
        foreach ($deviceTokens as $deviceToken) {
            $client = new Client();
            $crawler = $client->post($options['host'], array(), json_encode(array(
                'registration_ids' => (array) $deviceToken,
                'data' => $data,
            )), array(
                'headers' => array(
                    'Authorization' => 'key='.$options['key'],
                    'Content-Type' => 'application/json',
                ),
                'exceptions' => false,
                'verify' => false,
            ));
            $response[] = json_decode($crawler->send()->getBody());
        }

        return $response;
    }
}
