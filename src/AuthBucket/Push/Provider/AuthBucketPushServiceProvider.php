<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Provider;

use AuthBucket\Push\EventListener\ExceptionListener;
use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Push service provider as plugin for Silex SecurityServiceProvider.
 *
 * @author Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 */
class AuthBucketPushServiceProvider implements ServiceProviderInterface, ControllerProviderInterface
{
    public function register(Application $app)
    {
        // Override this with your backend model managers, e.g. Doctrine ORM
        // EntityRepository.
        $app['authbucket_push.model_manager.factory'] = null;

#        $app['authbucket_push.exception_listener'] = $app->share(function () {
#            return new ExceptionListener();
#        });
    }

    public function boot(Application $app)
    {
#        $app['dispatcher']->addListener(KernelEvents::EXCEPTION, array($app['authbucket_push.exception_listener'], 'onKernelException'), -8);
    }

    public function connect(Application $app)
    {
    }
}
