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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * GCM service type handler implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class GcmServiceTypeHandler extends AbstractServiceTypeHandler
{
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
