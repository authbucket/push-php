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
 * Push service interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface ServiceInterface extends ModelInterface
{
    /**
     * Set serviceId
     *
     * @param string $serviceId
     *
     * @return Service
     */
    public function setServiceId($serviceId);

    /**
     * Get serviceId
     *
     * @return string
     */
    public function getServiceId();

    /**
     * Set serviceType
     *
     * @param string $serviceType
     *
     * @return Service
     */
    public function setServiceType($serviceType);

    /**
     * Get serviceType
     *
     * @return string
     */
    public function getServiceType();

    /**
     * Set clientId
     *
     * @param string $clientId
     *
     * @return Service
     */
    public function setClientId($clientId);

    /**
     * Get clientId
     *
     * @return string
     */
    public function getClientId();

    /**
     * Set option
     *
     * @param array $option
     *
     * @return Service
     */
    public function setOption($option);

    /**
     * Get option
     *
     * @return array
     */
    public function getOption();
}
