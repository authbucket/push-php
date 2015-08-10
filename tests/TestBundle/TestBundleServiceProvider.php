<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Tests\TestBundle;

use AuthBucket\Push\Tests\TestBundle\Controller\DefaultController;
use AuthBucket\Push\Tests\TestBundle\Controller\DemoController;
use Silex\Application;
use Silex\ServiceProviderInterface;

/**
 * Test bundle provider.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class TestBundleServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['authbucket_push.tests.default_controller'] = $app->share(function () {
            return new DefaultController();
        });

        $app['authbucket_push.tests.demo_controller'] = $app->share(function () {
            return new DemoController();
        });
    }

    public function boot(Application $app)
    {
    }
}
