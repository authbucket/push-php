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

use AuthBucket\Push\Model\ModelManagerFactoryInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Shared service type implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
abstract class AbstractServiceTypeHandler implements ServiceTypeHandlerInterface
{
    protected $tokenStorage;
    protected $validator;
    protected $modelManagerFactory;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        ValidatorInterface $validator,
        ModelManagerFactoryInterface $modelManagerFactory
    ) {
        $this->tokenStorage = $tokenStorage;
        $this->validator = $validator;
        $this->modelManagerFactory = $modelManagerFactory;
    }

    protected function getDeviceTokens($serviceId, $username = '', $scope = [])
    {
        $deviceTokens = [];

        // Fetch all device belong to this service_id.
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy([
            'serviceId' => $serviceId,
        ]);

        // Prepare a list of device_token.
        foreach ($devices as $device) {
            // If belongs to named access_token, only send to that username.
            if ($username && $device->getUsername() !== $username) {
                continue;
            }

            // Must match at least one scope.
            if ($scope && !array_intersect($device->getScope(), $scope)) {
                continue;
            }

            $deviceTokens[] = $device->getDeviceToken();
        }

        return $deviceTokens;
    }
}
