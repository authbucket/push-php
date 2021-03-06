<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\ServiceType;

use Authbucket\Push\Model\MessageInterface;
use Authbucket\Push\Model\ServiceInterface;

/**
 * Push service type handler interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface ServiceTypeHandlerInterface
{
    public function send(ServiceInterface $service, MessageInterface $message);
}
