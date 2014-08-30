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
     * Set service_type
     *
     * @param string $serviceType
     *
     * @return Service
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
     * @return Service
     */
    public function setClientId($clientId);

    /**
     * Get client_id
     *
     * @return string
     */
    public function getClientId();

    /**
     * Set options
     *
     * @param array $options
     *
     * @return Service
     */
    public function setOptions($options);

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions();
}
