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

use AuthBucket\Push\Controller\ApplicationController;
use AuthBucket\Push\Controller\DeviceController;
use AuthBucket\Push\Controller\MessageController;
use AuthBucket\Push\Controller\PushController;
use AuthBucket\Push\Controller\VariantController;
use AuthBucket\Push\EventListener\ExceptionListener;
use AuthBucket\Push\VariantType\VariantTypeHandlerFactory;
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

        // Add default variant type handler.
        $app['authbucket_push.variant_handler'] = array(
            'apns' => 'AuthBucket\\Push\\VariantType\\ApnsVariantTypeHandler',
            'gcm' => 'AuthBucket\\Push\\VariantType\\GcmVariantTypeHandler',
        );

        $app['authbucket_push.exception_listener'] = $app->share(function () {
            return new ExceptionListener();
        });

        $app['authbucket_push.variant_handler.factory'] = $app->share(function ($app) {
            return new VariantTypeHandlerFactory(
                $app['security'],
                $app['validator'],
                $app['authbucket_push.model_manager.factory'],
                $app['authbucket_push.variant_handler']
            );
        });

        $app['authbucket_push.push_controller'] = $app->share(function () use ($app) {
            return new PushController(
                $app['validator'],
                $app['serializer'],
                $app['authbucket_push.model_manager.factory'],
                $app['authbucket_push.variant_handler.factory']
            );
        });

        $app['authbucket_push.application_controller'] = $app->share(function () use ($app) {
            return new ApplicationController(
                $app['validator'],
                $app['serializer'],
                $app['authbucket_push.model_manager.factory']
            );
        });

        $app['authbucket_push.variant_controller'] = $app->share(function () use ($app) {
            return new VariantController(
                $app['validator'],
                $app['serializer'],
                $app['authbucket_push.model_manager.factory']
            );
        });

        $app['authbucket_push.device_controller'] = $app->share(function () use ($app) {
            return new DeviceController(
                $app['validator'],
                $app['serializer'],
                $app['authbucket_push.model_manager.factory']
            );
        });

        $app['authbucket_push.message_controller'] = $app->share(function () use ($app) {
            return new MessageController(
                $app['validator'],
                $app['serializer'],
                $app['authbucket_push.model_manager.factory']
            );
        });
    }

    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $app->post('/api/v1.0/push/register.{_format}', 'authbucket_push.push_controller:registerAction')
            ->bind('api_push_register')
            ->assert('_format', 'json|xml');

        $app->post('/api/v1.0/push/unregister', 'authbucket_push.push_controller:unregisterAction')
            ->bind('api_push_unregister');

        $app->post('/api/v1.0/push/send', 'authbucket_push.push_controller:sendAction')
            ->bind('api_push_send');

        foreach (array('application', 'variant', 'device', 'message') as $type) {
            $app->post('/api/v1.0/'.$type.'.{_format}', 'authbucket_push.'.$type.'_controller:createAction')
                ->bind('api_'.$type.'_create')
                ->assert('_format', 'json|xml');

            $app->get('/api/v1.0/'.$type.'/{id}.{_format}', 'authbucket_push.'.$type.'_controller:readAction')
                ->bind('api_'.$type.'_read')
                ->assert('_format', 'json|xml');

            $app->put('/api/v1.0/'.$type.'/{id}.{_format}', 'authbucket_push.'.$type.'_controller:updateAction')
                ->bind('api_'.$type.'_update')
                ->assert('_format', 'json|xml');

            $app->delete('/api/v1.0/'.$type.'/{id}.{_format}', 'authbucket_push.'.$type.'_controller:deleteAction')
                ->bind('api_'.$type.'_delete')
                ->assert('_format', 'json|xml');

            $app->get('/api/v1.0/'.$type.'.{_format}', 'authbucket_push.'.$type.'_controller:listAction')
                ->bind('api_'.$type.'_list')
                ->assert('_format', 'json|xml');
        }

        return $controllers;
    }

    public function boot(Application $app)
    {
        $app['dispatcher']->addListener(KernelEvents::EXCEPTION, array($app['authbucket_push.exception_listener'], 'onKernelException'), -8);
    }
}
