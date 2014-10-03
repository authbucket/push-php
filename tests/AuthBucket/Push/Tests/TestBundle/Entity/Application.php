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

use AuthBucket\Push\Model\ApplicationInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Application
 *
 * @ORM\Table(name="authbucket_push_application")
 * @ORM\Entity(repositoryClass="AuthBucket\Push\Tests\TestBundle\Entity\ApplicationRepository")
 */
class Application implements ApplicationInterface
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
     * @var string
     *
     * @ORM\Column(name="application_secret", type="string", length=255)
     */
    protected $applicationSecret;

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
     * Set application_id
     *
     * @param string $applicationId
     *
     * @return Application
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
     * Set application_secret
     *
     * @param string $applicationSecret
     *
     * @return Application
     */
    public function setApplicationSecret($applicationSecret)
    {
        $this->applicationSecret = $applicationSecret;

        return $this;
    }

    /**
     * Get application_secret
     *
     * @return string
     */
    public function getApplicationSecret()
    {
        return $this->applicationSecret;
    }
}
