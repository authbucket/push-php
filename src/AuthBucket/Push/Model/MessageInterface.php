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
 * Push message interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface MessageInterface extends ModelInterface
{
    /**
     * Set clientId
     *
     * @param string $clientId
     *
     * @return Device
     */
    public function setClientId($clientId);

    /**
     * Get clientId
     *
     * @return string
     */
    public function getClientId();

    /**
     * Set serviceId
     *
     * @param array $serviceId
     *
     * @return Device
     */
    public function setServiceId($serviceId);

    /**
     * Get serviceId
     *
     * @return array
     */
    public function getServiceId();

    /**
     * Set username
     *
     * @param array $username
     *
     * @return Device
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return array
     */
    public function getUsername();

    /**
     * Set scope
     *
     * @param array $scope
     *
     * @return Device
     */
    public function setScope($scope);

    /**
     * Get scope
     *
     * @return array
     */
    public function getScope();

    /**
     * Set payload
     *
     * @param array $payload
     *
     * @return Device
     */
    public function setPayload($payload);

    /**
     * Get payload
     *
     * @return array
     */
    public function getPayload();
}
