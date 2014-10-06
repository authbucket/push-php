<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\VariantType;

/**
 * Push variant type handler factory interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface VariantTypeHandlerFactoryInterface
{
    /**
     * Gets a stored variant type handler.
     *
     * @param string $type Type of variant type handler, as refer to RFC6749.
     *
     * @return VariantTypeHandlerInterface The stored variant type handler.
     *
     * @throw UnsupportedVariantTypeException If supplied variant type not found.
     */
    public function getVariantTypeHandler($type = null);

    /**
     * Get a list of all supported handler.
     *
     * @return array Supported handler in key-value pair.
     */
    public function getVariantTypeHandlers();
}
