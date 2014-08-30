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
     * Set device_token
     *
     * @param string $deviceToken
     *
     * @return Device
     */
    public function setDeviceToken($deviceToken);

    /**
     * Get device_token
     *
     * @return string
     */
    public function getDeviceToken();

    /**
     * Set service_type
     *
     * @param string $serviceType
     *
     * @return Device
     */
    public function setServiceType($serviceType);

    /**
     * Get service_type
     *
     * @return string
     */
    public function getServiceType();

    /**
     * Set client_id
     *
     * @param string $clientId
     *
     * @return Device
     */
    public function setClientId($clientId);

    /**
     * Get client_id
     *
     * @return string
     */
    public function getClientId();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Device
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set expires
     *
     * @param \DateTime $expires
     *
     * @return Device
     */
    public function setExpires($expires);

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires();
}
