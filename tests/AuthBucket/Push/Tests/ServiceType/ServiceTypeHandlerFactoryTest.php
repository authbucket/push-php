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
        $responseTypeHandlerFactory = new ServiceTypeHandlerFactory(
            $this->app['security'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            array('foo' => 'AuthBucket\\Push\\Tests\\ServiceType\\NonExistsServiceTypeHandler')
        );
        $responseTypeHandlerFactory->addServiceTypeHandler('foo', $responseTypeHandler);
    }

    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedServiceTypeException
     */
    public function testBadAddServiceTypeHandler()
    {
        $responseTypeHandlerFactory = new ServiceTypeHandlerFactory(
            $this->app['security'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            array('foo' => 'AuthBucket\\Push\\Tests\\ServiceType\\FooServiceTypeHandler')
        );
        $responseTypeHandlerFactory->addServiceTypeHandler('foo', $responseTypeHandler);
    }

    /**
     * @expectedException \AuthBucket\Push\Exception\UnsupportedServiceTypeException
     */
    public function testBadGetServiceTypeHandler()
    {
        $responseTypeHandlerFactory = new ServiceTypeHandlerFactory(
            $this->app['security'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            array('bar' => 'AuthBucket\\Push\\Tests\\ServiceType\\BarServiceTypeHandler')
        );
        $responseTypeHandlerFactory->getServiceTypeHandler('foo');
    }

    public function testGoodGetServiceTypeHandler()
    {
        $responseTypeHandlerFactory = new ServiceTypeHandlerFactory(
            $this->app['security'],
            $this->app['validator'],
            $this->app['authbucket_push.model_manager.factory'],
            array('bar' => 'AuthBucket\\Push\\Tests\\ServiceType\\BarServiceTypeHandler')
        );
        $responseTypeHandlerFactory->getServiceTypeHandler('bar');
    }
}
