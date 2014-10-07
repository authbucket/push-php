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

use AuthBucket\Push\Model\DeviceInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Device
 *
 * @ORM\Table(name="authbucket_push_device")
 * @ORM\Entity(repositoryClass="AuthBucket\Push\Tests\TestBundle\Entity\DeviceRepository")
 */
class Device implements DeviceInterface
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
     * @ORM\Column(name="device_token", type="string", length=255)
     */
    protected $deviceToken;

    /**
     * @var string
     *
     * @ORM\Column(name="variant_id", type="string", length=255)
     */
    protected $variantId;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255)
     */
    protected $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="category", type="array")
     */
    protected $category;

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
     * Set deviceToken
     *
     * @param string $deviceToken
     *
     * @return Device
     */
    public function setDeviceToken($deviceToken)
    {
        $this->deviceToken = $deviceToken;

        return $this;
    }

    /**
     * Get deviceToken
     *
     * @return string
     */
    public function getDeviceToken()
    {
        return $this->deviceToken;
    }

    /**
     * Set variantId
     *
     * @param string $variantId
     *
     * @return Device
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
     * Set alias
     *
     * @param string $alias
     *
     * @return Device
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Device
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return array
     */
    public function getCategory()
    {
        return $this->category;
    }
}
