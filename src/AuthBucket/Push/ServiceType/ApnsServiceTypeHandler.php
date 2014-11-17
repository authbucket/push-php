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
 * APNs service type implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class ApnsServiceTypeHandler extends AbstractServiceTypeHandler
{
    public function send(ServiceInterface $service, MessageInterface $message)
    {
        $option = array_merge(array(
            'host' => 'ssl://gateway.sandbox.push.apple.com:2195',
            'local_cert' => '',
            'passphrase' => '',
        ), $service->getOption());
        $payload = array_merge(array(
            'alert' => '',
            'sound' => 'default.wav',
            'badge' => 1,
            'expire_in' => 60*60*24*7,
        ), $message->getPayload());

        // Fetch all device belong to this service_id.
        $deviceTokens = $this->getDeviceTokens(
            $service->getServiceId(),
            $message->getUsername(),
            $message->getScope()
        );

        // PHP SSL implementation need local_cert as physical file.
        // @see http://stackoverflow.com/a/11403788
        $local_cert = tempnam(sys_get_temp_dir(), 'PEM');
        register_shutdown_function('unlink', $local_cert);
        $handler = fopen($local_cert, 'w');
        fwrite($handler, $option['local_cert']);
        fclose($handler);

        foreach ($deviceTokens as $deviceToken) {
            // Prepare the payload in JSON format.
            $_payload = json_encode(array(
                'aps' => array(
                    'alert' => $payload['alert'],
                    'badge' => $payload['badge'],
                    'sound' => $payload['sound'],
                ),
            ));

            // Build the message.
            $_message = pack('CnH*', 1, 32, $deviceToken);
            $_message .= pack('Cn', 2, strlen($_payload)).$_payload;
            $_message .= pack('CnN', 3, 4, $message->getMessageId());
            $_message .= pack('CnN', 4, 4, $payload['expire_in']);
            $_message .= pack('CnC', 5, 1, 10);
            $_message = pack('CN', 2, strlen($_message)).$_message;

            // Create and write to the stream.
            $_context = stream_context_create();
            stream_context_set_option($_context, 'ssl', 'local_cert', $local_cert);
            stream_context_set_option($_context, 'ssl', 'passphrase', $option['passphrase']);
            $_handler = stream_socket_client(
                $option['host'],
                $error,
                $errorString,
                10,
                STREAM_CLIENT_ASYNC_CONNECT,
                $_context
            );
            fwrite($_handler, $_message);
            fclose($_handler);
        }
    }
}
