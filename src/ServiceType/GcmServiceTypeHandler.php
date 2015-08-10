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

use AuthBucket\Push\Model\MessageInterface;
use AuthBucket\Push\Model\ServiceInterface;
use Guzzle\Http\Client;

/**
 * GCM service type handler implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class GcmServiceTypeHandler extends AbstractServiceTypeHandler
{
    public function send(ServiceInterface $service, MessageInterface $message)
    {
        $option = array_merge(array(
            'host' => 'https://android.googleapis.com/gcm/send',
            'key' => '',
        ), $service->getOption());
        $payload = array_merge(array(
            'alert' => '',
            'sound' => 'default.wav',
            'badge' => 1,
            'expire_in' => 60 * 60 * 24 * 7,
        ), $message->getPayload());

        // Fetch all device belong to this service_id.
        $deviceTokens = $this->getDeviceTokens(
            $service->getServiceId(),
            $message->getUsername(),
            $message->getScope()
        );

        foreach ($deviceTokens as $deviceToken) {
            $client = new Client();
            $crawler = $client->post($option['host'], array(), json_encode(array(
                'registration_ids' => (array) $deviceToken,
                'data' => array(
                    'alert' => $payload['alert'],
                    'sound' => $payload['sound'],
                    'badge' => $payload['badge'],
                ),
                'time_to_live' => $payload['expire_in'],
            )), array(
                'headers' => array(
                    'Authorization' => 'key='.$option['key'],
                    'Content-Type' => 'application/json',
                ),
                'exceptions' => false,
                'verify' => false,
            ));
            $response = json_decode($crawler->send()->getBody());
        }
    }
}
