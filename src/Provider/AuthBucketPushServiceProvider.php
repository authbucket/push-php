<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AuthBucket\Push\Provider;

use AuthBucket\Push\Controller\PushController;
use AuthBucket\Push\EventListener\ExceptionListener;
use AuthBucket\Push\ServiceType\ServiceTypeHandlerFactory;
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

        // Add default service type handler.
        $app['authbucket_push.service_handler'] = array(
            'apns' => 'AuthBucket\\Push\\ServiceType\\ApnsServiceTypeHandler',
            'gcm' => 'AuthBucket\\Push\\ServiceType\\GcmServiceTypeHandler',
        );

        $app['authbucket_push.exception_listener'] = $app->share(function () {
            return new ExceptionListener();
        });

        $app['authbucket_push.service_handler.factory'] = $app->share(function ($app) {
            return new ServiceTypeHandlerFactory(
                $app['security'],
                $app['validator'],
                $app['authbucket_push.model_manager.factory'],
                $app['authbucket_push.service_handler']
            );
        });

        $app['authbucket_push.push_controller'] = $app->share(function () use ($app) {
            return new PushController(
                $app['security'],
                $app['validator'],
                $app['authbucket_push.model_manager.factory'],
                $app['authbucket_push.service_handler.factory']
            );
        });
    }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $app->post('/api/v1.0/push/register', 'authbucket_push.push_controller:registerAction')
            ->bind('api_push_register');

        $app->post('/api/v1.0/push/unregister', 'authbucket_push.push_controller:unregisterAction')
            ->bind('api_push_unregister');

        $app->post('/api/v1.0/push/send', 'authbucket_push.push_controller:sendAction')
            ->bind('api_push_send');

        return $controllers;
    }

    public function boot(Application $app)
    {
        $app['dispatcher']->addListener(KernelEvents::EXCEPTION, array($app['authbucket_push.exception_listener'], 'onKernelException'), -8);
    }
}
