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

use AuthBucket\Push\ServiceType\ServiceTypeHandlerFactory;
use AuthBucket\Push\Tests\WebTestCase;

class ServiceTypeHandlerFactoryTest extends WebTestCase
{
    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedServiceTypeException
     */
    public function testNonExistsServiceTypeHandler()
    {
        $classes = ['foo' => 'AuthBucket\\Push\\Tests\\ServiceType\\NonExistsServiceTypeHandler'];
        $factory = new ServiceTypeHandlerFactory(
            $this->app['security.token_storage'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            $classes
        );
    }

    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedServiceTypeException
     */
    public function testBadAddServiceTypeHandler()
    {
        $classes = ['foo' => 'AuthBucket\\Push\\Tests\\ServiceType\\FooServiceTypeHandler'];
        $factory = new ServiceTypeHandlerFactory(
            $this->app['security.token_storage'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            $classes
        );
    }

    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedServiceTypeException
     */
    public function testBadGetServiceTypeHandler()
    {
        $classes = ['bar' => 'AuthBucket\\Push\\Tests\\ServiceType\\BarServiceTypeHandler'];
        $factory = new ServiceTypeHandlerFactory(
            $this->app['security.token_storage'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            $classes
        );
        $handler = $factory->getServiceTypeHandler('foo');
    }

    public function testGoodGetServiceTypeHandler()
    {
        $classes = ['bar' => 'AuthBucket\\Push\\Tests\\ServiceType\\BarServiceTypeHandler'];
        $factory = new ServiceTypeHandlerFactory(
            $this->app['security.token_storage'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            $classes
        );
        $handler = $factory->getServiceTypeHandler('bar');
        $this->assertSame($factory->getServiceTypeHandlers(), $classes);
    }
}
