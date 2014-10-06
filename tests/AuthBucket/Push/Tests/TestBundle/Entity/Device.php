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
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    protected $username;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetime")
     */
    protected $expires;

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
     * Set device_token
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
     * Get device_token
     *
     * @return string
     */
    public function getDeviceToken()
    {
        return $this->deviceToken;
    }

    /**
     * Set variant_type
     *
     * @param string $variantType
     *
     * @return Device
     */
    public function setVariantType($variantType)
    {
        $this->variantType = $variantType;

        return $this;
    }

    /**
     * Get variant_type
     *
     * @return string
     */
    public function getVariantType()
    {
        return $this->variantType;
    }

    /**
     * Set application_id
     *
     * @param string $applicationId
     *
     * @return Device
     */
    public function setApplicationId($applicationId)
    {
        $this->applicationId = $applicationId;

        return $this;
    }

    /**
     * Get application_id
     *
     * @return string
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Device
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     *
     * @return Device
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime
     */
    public function getExpires()
    {
        return $this->expires;
    }
}
