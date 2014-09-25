<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\ServiceType;

use Guzzle\Http\Client;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * GCM service type handler implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class GcmServiceTypeHandler extends AbstractServiceTypeHandler
{
    public function register(Request $request)
    {
        $clientId = $this->checkClientId();

        $username = $this->checkUsername();

        $deviceToken = $this->checkDeviceToken($request);

        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $class = $deviceManager->getClassName();
        $device = new $class();
        $device->setDeviceToken($deviceToken)
            ->setServiceType('gcm')
            ->setClientId($clientId)
            ->setUsername($username)
            ->setExpires(new \DateTime('+7 days'));
        $device = $deviceManager->createModel($device);

        $parameters = array(
            'device_token' => $device->getDeviceToken(),
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

    public function unregister(Request $request)
    {
        $clientId = $this->checkClientId();

        $username = $this->checkUsername();

        $deviceToken = $this->checkDeviceToken($request);

        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'deviceToken' => $deviceToken,
            'serviceType' => 'gcm',
            'clientId' => $clientId,
            'username' => $username,
        ));
        foreach ($devices as $device) {
            $deviceManager->deleteModel($device);
        }

        return new Response();
    }

    public function send(Request $request)
    {
        $clientId = $this->checkClientId();

        $username = $this->checkUsername();

        $data = $this->checkData($request);

        $serviceManager = $this->modelManagerFactory->getModelManager('service');
        $service = $serviceManager->readModelOneBy(array(
            'serviceType' => 'gcm',
            'clientId' => $clientId,
        ));
        $options = $service->getOptions();

        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'serviceType' => 'gcm',
            'clientId' => $clientId,
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
