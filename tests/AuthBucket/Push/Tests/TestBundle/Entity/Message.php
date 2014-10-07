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

use AuthBucket\Push\Model\MessageInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="authbucket_push_message")
 * @ORM\Entity(repositoryClass="AuthBucket\Push\Tests\TestBundle\Entity\MessageRepository")
 */
class Message implements MessageInterface
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
     * @ORM\Column(name="application_id", type="string", length=255)
     */
    protected $applicationId;

    /**
     * @var array
     *
     * @ORM\Column(name="variant_id", type="array")
     */
    protected $variantId;

    /**
     * @var array
     *
     * @ORM\Column(name="alias", type="array")
     */
    protected $alias;

    /**
     * @var array
     *
     * @ORM\Column(name="category", type="array")
     */
    protected $category;

    /**
     * @var array
     *
     * @ORM\Column(name="payload", type="array")
     */
    protected $payload;

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
     * Set applicationId
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
     * Get applicationId
     *
     * @return string
     */
    public function getApplicationId()
    {
        return $this->applicationId;
    }

    /**
     * Set variantId
     *
     * @param array $variantId
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
     * @return array
     */
    public function getVariantId()
    {
        return $this->variantId;
    }

    /**
     * Set alias
     *
     * @param array $alias
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
     * @return array
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set category
     *
     * @param array $category
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

    /**
     * Set payload
     *
     * @param array $payload
     *
     * @return Device
     */
    public function setPayload($payload)
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Get payload
     *
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }
}
