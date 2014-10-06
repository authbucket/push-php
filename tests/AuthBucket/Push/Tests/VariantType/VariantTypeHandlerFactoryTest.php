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

use AuthBucket\Push\VariantType\VariantTypeHandlerFactory;
use AuthBucket\Push\Tests\WebTestCase;

class VariantTypeHandlerFactoryTest extends WebTestCase
{
    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedVariantTypeException
     */
    public function testNonExistsVariantTypeHandler()
    {
        $classes = array('foo' => 'AuthBucket\\Push\\Tests\\VariantType\\NonExistsVariantTypeHandler');
        $factory = new VariantTypeHandlerFactory(
            $this->app['security'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            $classes
        );
    }

    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedVariantTypeException
     */
    public function testBadAddVariantTypeHandler()
    {
        $classes = array('foo' => 'AuthBucket\\Push\\Tests\\VariantType\\FooVariantTypeHandler');
        $factory = new VariantTypeHandlerFactory(
            $this->app['security'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            $classes
        );
    }

    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedVariantTypeException
     */
    public function testBadGetVariantTypeHandler()
    {
        $classes = array('bar' => 'AuthBucket\\Push\\Tests\\VariantType\\BarVariantTypeHandler');
        $factory = new VariantTypeHandlerFactory(
            $this->app['security'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            $classes
        );
        $handler = $factory->getVariantTypeHandler('foo');
    }

    public function testGoodGetVariantTypeHandler()
    {
        $classes = array('bar' => 'AuthBucket\\Push\\Tests\\VariantType\\BarVariantTypeHandler');
        $factory = new VariantTypeHandlerFactory(
            $this->app['security'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            $classes
        );
        $handler = $factory->getVariantTypeHandler('bar');
        $this->assertEquals($factory->getVariantTypeHandlers(), $classes);
    }
}
