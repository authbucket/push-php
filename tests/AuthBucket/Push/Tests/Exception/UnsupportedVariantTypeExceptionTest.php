<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\Exception;

use AuthBucket\Push\Exception\UnsupportedVariantTypeException;

/**
 * Test unsupported service type exception.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class UnsupportedVariantTypeExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedVariantTypeException
     */
    public function testUnsupportedVariantTypeExceptionTest()
    {
        throw new UnsupportedVariantTypeException();
    }
}
