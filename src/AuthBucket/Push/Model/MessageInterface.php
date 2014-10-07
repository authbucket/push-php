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
     * Set applicationId
     *
     * @param string $applicationId
     *
     * @return Device
     */
    public function setApplicationId($applicationId);

    /**
     * Get applicationId
     *
     * @return string
     */
    public function getApplicationId();

    /**
     * Set variantId
     *
     * @param array $variantId
     *
     * @return Device
     */
    public function setVariantId($variantId);

    /**
     * Get variantId
     *
     * @return array
     */
    public function getVariantId();

    /**
     * Set alias
     *
     * @param array $alias
     *
     * @return Device
     */
    public function setAlias($alias);

    /**
     * Get alias
     *
     * @return array
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
