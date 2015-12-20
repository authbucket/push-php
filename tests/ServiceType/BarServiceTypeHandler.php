<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\ServiceType;

use AuthBucket\Push\Model\MessageInterface;
use AuthBucket\Push\Model\ServiceInterface;
use AuthBucket\Push\ServiceType\ServiceTypeHandlerInterface;

class BarServiceTypeHandler implements ServiceTypeHandlerInterface
{
    public function send(ServiceInterface $service, MessageInterface $message)
    {
    }
}
