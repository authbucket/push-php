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
     * Set variantId
     *
     * @param string $variantId
     *
     * @return Variant
     */
    public function setVariantId($variantId);

    /**
     * Get variantId
     *
     * @return string
     */
    public function getVariantId();

    /**
     * Set variantSecret
     *
     * @param string $variantSecret
     *
     * @return Variant
     */
    public function setVariantSecret($variantSecret);

    /**
     * Get variantSecret
     *
     * @return string
     */
    public function getVariantSecret();

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
     * Set applicationId
     *
     * @param string $applicationId
     *
     * @return Variant
     */
    public function setApplicationId($applicationId);

    /**
     * Get applicationId
     *
     * @return string
     */
    public function getApplicationId();

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
