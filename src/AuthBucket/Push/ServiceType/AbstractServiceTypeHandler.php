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
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Validator\ValidatorInterface;

/**
 * Shared service type implementation.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
abstract class AbstractServiceTypeHandler implements ServiceTypeHandlerInterface
{
    protected $securityContext;
    protected $validator;
    protected $modelManagerFactory;

    public function __construct(
        SecurityContextInterface $securityContext,
        ValidatorInterface $validator,
        ModelManagerFactoryInterface $modelManagerFactory
    ) {
        $this->securityContext = $securityContext;
        $this->validator = $validator;
        $this->modelManagerFactory = $modelManagerFactory;
    }

    protected function getDeviceTokens($serviceId, $username = '', $scope = array())
    {
        $deviceTokens = array();

        // Fetch all device belong to this service_id.
        $deviceManager = $this->modelManagerFactory->getModelManager('device');
        $devices = $deviceManager->readModelBy(array(
            'serviceId' => $serviceId,
        ));

        // Prepare a list of device_token.
        foreach ($devices as $device) {
            // If belongs to named access_token, only send to that username.
            if ($username && $device->getUsername() !== $username) {
                continue;
            }

            // Must match at least one scope.
            if (!array_intersect($device->getScope(), $scope)) {
                continue;
            }

            $deviceTokens[] = $device->getDeviceToken();
        }

        return $deviceTokens;
    }
}
