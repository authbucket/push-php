<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\VariantType;

use AuthBucket\Push\VariantType\VariantTypeHandlerInterface;
use Symfony\Component\HttpFoundation\Request;

class BarVariantTypeHandler implements VariantTypeHandlerInterface
{
    public function register(Request $request)
    {
    }

    public function unregister(Request $request)
    {
    }

    public function send(Request $request)
    {
    }
}
