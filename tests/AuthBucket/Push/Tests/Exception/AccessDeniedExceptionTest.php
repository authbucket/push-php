<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\Exception;

use AuthBucket\Push\Exception\AccessDeniedException;

/**
 * Test access denied exception.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class AccessDeniedExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \AuthBucket\Push\Exception\AccessDeniedException
     */
    public function testAccessDeniedException()
    {
        throw new AccessDeniedException();
    }
}
