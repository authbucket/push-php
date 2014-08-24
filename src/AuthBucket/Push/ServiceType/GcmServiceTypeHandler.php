<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\ServiceType;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * GCM service type handler implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class GcmServiceTypeHandler extends AbstractServiceTypeHandler
{
    public function registerDevice(Request $request)
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

    public function sendMessage(Request $request)
    {
    }
}
