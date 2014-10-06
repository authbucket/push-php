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
     * Set variant_type
     *
     * @param string $variantType
     *
     * @return Device
     */
    public function setVariantType($variantType);

    /**
     * Get variant_type
     *
     * @return string
     */
    public function getVariantType();

    /**
     * Set application_id
     *
     * @param string $applicationId
     *
     * @return Device
     */
    public function setApplicationId($applicationId);

    /**
     * Get application_id
     *
     * @return string
     */
    public function getApplicationId();

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
