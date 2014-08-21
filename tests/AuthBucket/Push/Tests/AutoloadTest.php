<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests;

/**
 * Test if autoload able to discover all required classes.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class AutoloadTest extends \PHPUnit_Framework_TestCase
{
    public function testExceptionClassesExist()
    {
        $this->assertTrue(class_exists('AuthBucket\Push\Exception\AccessDeniedException'));
        $this->assertTrue(class_exists('AuthBucket\Push\Exception\InvalidRequestException'));
        $this->assertTrue(class_exists('AuthBucket\Push\Exception\ServerErrorException'));
        $this->assertTrue(class_exists('AuthBucket\Push\Exception\TemporarilyUnavailableException'));
    }
}
