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

/**
 * Push service type handler factory interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface ServiceTypeHandlerFactoryInterface
{
    /**
     * Gets a stored service type handler.
     *
     * @param string $type Type of service type handler, as refer to RFC6749.
     *
     * @return ServiceTypeHandlerInterface The stored service type handler.
     *
     * @throw UnsupportedServiceTypeException If supplied service type not found.
     */
    public function getServiceTypeHandler($type = null);

    /**
     * Get a list of all supported handler.
     *
     * @return array Supported handler in key-value pair.
     */
    public function getServiceTypeHandlers();
}
