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
     * Set messageId
     *
     * @param string $messageId
     *
     * @return Message
     */
    public function setMessageId($messageId);

    /**
     * Get messageId
     *
     * @return string
     */
    public function getMessageId();

    /**
     * Set clientId
     *
     * @param string $clientId
     *
     * @return Message
     */
    public function setClientId($clientId);

    /**
     * Get clientId
     *
     * @return string
     */
    public function getClientId();

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Message
     */
    public function setUsername($username);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Set scope
     *
     * @param array $scope
     *
     * @return Message
     */
    public function setScope($scope);

    /**
     * Get scope
     *
     * @return array
     */
    public function getScope();

    /**
     * Set payload
     *
     * @param array $payload
     *
     * @return Message
     */
    public function setPayload($payload);

    /**
     * Get payload
     *
     * @return array
     */
    public function getPayload();
}
