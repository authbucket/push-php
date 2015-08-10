<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Model;

/**
 * Push device interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface DeviceInterface extends ModelInterface
{
    /**
     * Set deviceToken.
     *
     * @param string $deviceToken
     *
     * @return Device
     */
    public function setDeviceToken($deviceToken);

    /**
     * Get deviceToken.
     *
     * @return string
     */
    public function getDeviceToken();

    /**
     * Set serviceId.
     *
     * @param string $serviceId
     *
     * @return Device
     */
    public function setServiceId($serviceId);

    /**
     * Get serviceId.
     *
     * @return string
     */
    public function getServiceId();

    /**
     * Set username.
     *
     * @param string $username
     *
     * @return Device
     */
    public function setUsername($username);

    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set scope.
     *
     * @param array $scope
     *
     * @return Device
     */
    public function setScope($scope);

    /**
     * Get scope.
     *
     * @return array
     */
    public function getScope();
}
