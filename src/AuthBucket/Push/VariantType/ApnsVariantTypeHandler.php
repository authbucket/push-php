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

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * APNs variant type implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class ApnsVariantTypeHandler extends AbstractVariantTypeHandler
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
            ->setVariantType('apns')
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
            'variantType' => 'apns',
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
            'variantType' => 'apns',
            'applicationId' => $applicationId,
        ));
        $options = $variant->getOptions();

        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'variantType' => 'apns',
            'applicationId' => $applicationId,
            'username' => $username,
        ));

        $deviceTokens = array();
        foreach ($devices as $device) {
            if ($device->getExpires() > new \DateTime()) {
                $deviceTokens[$device->getDeviceToken()] = $device->getDeviceToken();
            }
        }

        // PHP SSL implementation need local_cert as physical file.
        // @see http://stackoverflow.com/a/11403788
        $local_cert = tempnam(sys_get_temp_dir(), 'PEM');
        register_shutdown_function('unlink', $local_cert);
        $handler = fopen($local_cert, 'w');
        fwrite($handler, $options['local_cert']);
        fclose($handler);

        $response = array();
        foreach ($deviceTokens as $deviceToken) {
            // Prepare the payload in JSON format.
            $payload = json_encode(array(
                'aps' => array(
                    'alert' => $data['message'],
                    'badge' => 1,
                    'sound' => 'default',
                ),
            ));

            // Build the message.
            $message = pack('CnH*', 1, 32, $deviceToken);
            $message .= pack('Cn', 2, strlen($payload)).$payload;
            $message .= pack('CnN', 3, 4, md5(uniqid(null, true)));
            $message .= pack('CnN', 4, 4, 60*60*24*7);
            $message .= pack('CnC', 5, 1, 10);
            $message = pack('CN', 2, strlen($message)).$message;

            // Create and write to the stream.
            $context = stream_context_create();
            stream_context_set_option($context, 'ssl', 'local_cert', $local_cert);
            stream_context_set_option($context, 'ssl', 'passphrase', $options['passphrase']);
            $handler = stream_socket_client(
                $options['host'],
                $error,
                $errorString,
                10,
                STREAM_CLIENT_ASYNC_CONNECT,
                $context
            );
            fwrite($handler, $message);
            fclose($handler);

            $response[] = $errorString;
        }

        return $response;
    }
}
