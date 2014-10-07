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
 * Push application interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface ApplicationInterface extends ModelInterface
{
    /**
     * Set applicationId
     *
     * @param string $applicationId
     *
     * @return Application
     */
    public function setApplicationId($applicationId);

    /**
     * Get applicationId
     *
     * @return string
     */
    public function getApplicationId();

    /**
     * Set applicationSecret
     *
     * @param string $applicationSecret
     *
     * @return Application
     */
    public function setApplicationSecret($applicationSecret);

    /**
     * Get applicationSecret
     *
     * @return string
     */
    public function getApplicationSecret();
}
