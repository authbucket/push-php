<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$app->get('/', 'authbucket_push.tests.default_controller:indexAction')
    ->bind('index');

$app->get('/admin/refresh_database', 'authbucket_push.tests.default_controller:adminRefreshDatabaseAction')
    ->bind('admin_refresh_database');

$app->get('/getting-started', 'authbucket_push.tests.default_controller:gettingStartedIndexAction')
    ->bind('getting-started');

$app->get('/demo', 'authbucket_push.tests.demo_controller:indexAction')
    ->bind('demo');

$app->match('/api/oauth2/debug', 'authbucket_push.tests.oauth2_controller:debugAction')
    ->bind('api_oauth2_debug')
    ->method('GET|POST');

$app->post('/api/push/register', 'authbucket_push.push_controller:registerAction')
    ->bind('api_push_register');

$app->post('/api/push/unregister', 'authbucket_push.push_controller:unregisterAction')
    ->bind('api_push_unregister');

$app->post('/api/push/send', 'authbucket_push.push_controller:sendAction')
    ->bind('api_push_send');
