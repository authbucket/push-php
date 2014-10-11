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
     * Set deviceToken
     *
     * @param string $deviceToken
     *
     * @return Device
     */
    public function setDeviceToken($deviceToken);

    /**
     * Get deviceToken
     *
     * @return string
     */
    public function getDeviceToken();

    /**
     * Set serviceId
     *
     * @param string $serviceId
     *
     * @return Device
     */
    public function setServiceId($serviceId);

    /**
     * Get serviceId
     *
     * @return string
     */
    public function getServiceId();

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return Device
     */
    public function setAlias($alias);

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias();

    /**
     * Set category
     *
     * @param array $category
     *
     * @return Device
     */
    public function setCategory($category);

    /**
     * Get category
     *
     * @return array
     */
    public function getCategory();
}
