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

use AuthBucket\Push\Exception\InvalidRequestException;
use AuthBucket\Push\Validator\Constraints\DeviceId;
use AuthBucket\Push\Validator\Constraints\ServiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Shared service type implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
abstract class AbstractServiceTypeHandler implements ServiceTypeHandlerInterface
{
    private function checkClientId()
    {
        // Fetch client_id from securityContext.
        return $this->securityContext->getToken()->getAccessToken()->getClientId();
    }

    private function checkUsername()
    {
        // Fetch username from securityContext.
        return $this->securityContext->getToken()->getAccessToken()->getUsername();
    }

    private function checkDeviceId(Request $request)
    {
        // Fetch device_id from POST
        $deviceId = $request->request->get('device_id');
        $errors = $this->validator->validateValue($deviceId, array(
            new NotBlank(),
            new DeviceId(),
        ));
        if (count($errors) > 0) {
            throw new InvalidRequestException(array(
                'error_description' => 'The request includes an invalid parameter value.',
            ));
        }

        return $deviceId;
    }
}
