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

use AuthBucket\Push\Model\ServiceInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Service
 *
 * @ORM\Table(name="authbucket_push_service")
 * @ORM\Entity(repositoryClass="AuthBucket\Push\Tests\TestBundle\Entity\ServiceRepository")
 */
class Service implements ServiceInterface
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
     * @ORM\Column(name="service_id", type="string", length=255)
     */
    protected $serviceId;

    /**
     * @var string
     *
     * @ORM\Column(name="service_type", type="string", length=255)
     */
    protected $serviceType;

    /**
     * @var string
     *
     * @ORM\Column(name="application_id", type="string", length=255)
     */
    protected $clientId;

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
     * Set serviceId
     *
     * @param string $serviceId
     *
     * @return Service
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * Get serviceId
     *
     * @return string
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Set serviceType
     *
     * @param string $serviceType
     *
     * @return Service
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    /**
     * Get serviceType
     *
     * @return string
     */
    public function getServiceType()
    {
        return $this->serviceType;
    }

    /**
     * Set clientId
     *
     * @param string $clientId
     *
     * @return Service
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set options
     *
     * @param array $options
     *
     * @return Service
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
