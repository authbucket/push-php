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

/**
 * GCM service type handler implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class GcmServiceTypeHandler extends AbstractServiceTypeHandler
{
    public function send(ServiceInterface $service, MessageInterface $message)
    {
        $option = array_merge([
            'host' => 'https://gcm-http.googleapis.com/gcm/send',
            'key' => '',
        ], $service->getOption());
        $payload = array_merge([
            'alert' => '',
            'sound' => 'default.wav',
            'badge' => 1,
            'expire_in' => 60 * 60 * 24 * 7,
        ], $message->getPayload());

        // Fetch all device belong to this service_id.
        $deviceTokens = $this->getDeviceTokens(
            $service->getServiceId(),
            $message->getUsername(),
            $message->getScope()
        );

        foreach ($deviceTokens as $deviceToken) {
            $client = new \GuzzleHttp\Client();
            $crawler = $client->post($option['host'], [
                'headers' => [
                    'Authorization' => 'key='.$option['key'],
                    'Content-Type' => 'application/json',
                ],
                'body' => json_encode([
                    'to' => $deviceToken,
                    'data' => [
                        'alert' => $payload['alert'],
                        'sound' => $payload['sound'],
                        'badge' => $payload['badge'],
                    ],
                    'time_to_live' => $payload['expire_in'],
                ]),
            ]);

            if ($crawler->getStatusCode() !== 200) {
                throw new ServerErrorException([
                    'error_description' => sprintf("GCM: Message ID %d can't send to Device Token %s, error message: %s", $message->getMessageId(), $deviceToken, $crawler->getBody()),
                ]);
            }
        }
    }
}
