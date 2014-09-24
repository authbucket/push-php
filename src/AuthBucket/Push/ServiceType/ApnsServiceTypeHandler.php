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

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * APNs service type implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class ApnsServiceTypeHandler extends AbstractServiceTypeHandler
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
            ->setServiceType('apns')
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
            'serviceType' => 'apns',
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
            'serviceType' => 'apns',
            'clientId' => $clientId,
        ));
        $options = $service->getOptions();

        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'serviceType' => 'apns',
            'clientId' => $clientId,
            'username' => $username,
        ));

        // PHP SSL implementation need local_cert as physical file.
        // @see http://stackoverflow.com/a/11403788
        $local_cert = tempnam(sys_get_temp_dir(), 'PEM');
        register_shutdown_function('unlink', $local_cert);
        $handler = fopen($local_cert, 'w');
        fwrite($handler, $options['local_cert']);
        fclose($handler);

        $response = array();
        foreach ($devices as $device) {
            // Prepare the payload in JSON format.
            $payload = json_encode(array(
                'aps' => array(
                    'alert' => $data['message'],
                    'badge' => 1,
                    'sound' => 'default',
                ),
            ));

            // Build the message.
            $message = chr(0);
            $message .= chr(0).chr(32).pack('H*', $device->getDeviceToken());
            $message .= chr(0).chr(strlen($payload)).$payload;

            // Create and write to the stream.
            $context = stream_context_create();
            stream_context_set_option($context, 'ssl', 'local_cert', $local_cert);
            stream_context_set_option($context, 'ssl', 'passphrase', $options['passphrase']);
            $handler = stream_socket_client(
                $options['host'],
                $error,
                $errorString,
                3,
                STREAM_CLIENT_CONNECT,
                $context
            );
            fwrite($handler, $message);
            fclose($handler);

            $response[] = $errorString;
        }

        return $response;
    }
}
