<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\ServiceType;

use Symfony\Component\HttpFoundation\Request;

/**
 * Push service type handler interface.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
interface ServiceTypeHandlerInterface
{
    public function registerDeviceId(Request $request);

    public function sendMessage(Request $request);
}
