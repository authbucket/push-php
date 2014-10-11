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
