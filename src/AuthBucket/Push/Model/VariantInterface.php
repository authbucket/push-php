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
 * Push variant interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface VariantInterface extends ModelInterface
{
    /**
     * Set variantType
     *
     * @param string $variantType
     *
     * @return Variant
     */
    public function setVariantType($variantType);

    /**
     * Get variantType
     *
     * @return string
     */
    public function getVariantType();

    /**
     * Set client_id
     *
     * @param string $clientId
     *
     * @return Variant
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
     * @return Variant
     */
    public function setOptions($options);

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions();
}
