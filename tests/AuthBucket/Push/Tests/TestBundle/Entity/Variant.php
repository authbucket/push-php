<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\TestBundle\Entity;

use AuthBucket\Push\Model\VariantInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Variant
 *
 * @ORM\Table(name="authbucket_push_variant")
 * @ORM\Entity(repositoryClass="AuthBucket\Push\Tests\TestBundle\Entity\VariantRepository")
 */
class Variant implements VariantInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="variant_id", type="string", length=255)
     */
    protected $variantId;

    /**
     * @var string
     *
     * @ORM\Column(name="variant_secret", type="string", length=255)
     */
    protected $variantSecret;

    /**
     * @var string
     *
     * @ORM\Column(name="variant_type", type="string", length=255)
     */
    protected $variantType;

    /**
     * @var string
     *
     * @ORM\Column(name="application_id", type="string", length=255)
     */
    protected $applicationId;

    /**
     * @var array
     *
     * @ORM\Column(name="options", type="array")
     */
    protected $options;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set variantId
     *
     * @param string $variantId
     *
     * @return Variant
     */
    public function setVariantId($variantId)
    {
        $this->variantId = $variantId;

        return $this;
    }

    /**
     * Get variantId
     *
     * @return string
     */
    public function getVariantId()
    {
        return $this->variantId;
    }

    /**
     * Set variantSecret
     *
     * @param string $variantSecret
     *
     * @return Variant
     */
    public function setVariantSecret($variantSecret)
    {
        $this->variantSecret = $variantSecret;

        return $this;
    }

    /**
     * Get variantSecret
     *
     * @return string
     */
    public function getVariantSecret()
    {
        return $this->variantSecret;
    }

    /**
     * Set variantType
     *
     * @param string $variantType
     *
     * @return Variant
     */
    public function setVariantType($variantType)
    {
        $this->variantType = $variantType;

        return $this;
    }

    /**
     * Get variantType
     *
     * @return string
     */
    public function getVariantType()
    {
        return $this->variantType;
    }

    /**
     * Set applicationId
     *
     * @param string $applicationId
     *
     * @return Variant
     */
    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;

        return $this;
    }

    /**
     * Get applicationId
     *
     * @return string
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * Set options
     *
     * @param array $options
     *
     * @return Variant
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }
}
