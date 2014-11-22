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

$app->get('/demo', 'authbucket_push.tests.demo_controller:indexAction')
    ->bind('demo');

$app->get('/push', 'authbucket_push.tests.push_controller:indexAction')
    ->bind('push');

$app->get('/push/login', 'authbucket_push.tests.push_controller:loginAction')
    ->bind('push_login');

$app->match('/dummy/v1.0/oauth2/debug', 'authbucket_push.tests.oauth2_controller:debugAction')
    ->bind('dummy_oauth2_debug')
    ->method('GET|POST');

$app->post('/dummy/v1.0/push/register', 'authbucket_push.push_controller:registerAction')
    ->bind('dummy_push_register');

$app->post('/dummy/v1.0/push/unregister', 'authbucket_push.push_controller:unregisterAction')
    ->bind('dummy_push_unregister');

$app->post('/dummy/v1.0/push/send', 'authbucket_push.push_controller:sendAction')
    ->bind('dummy_push_send');

foreach (array('service', 'device', 'message') as $type) {
    $app->post('/dummy/v1.0/'.$type.'.{_format}', 'authbucket_push.'.$type.'_controller:createAction')
        ->bind('dummy_'.$type.'_create')
        ->assert('_format', 'json|xml');

    $app->get('/dummy/v1.0/'.$type.'/{id}.{_format}', 'authbucket_push.'.$type.'_controller:readAction')
        ->bind('dummy_'.$type.'_read')
        ->assert('_format', 'json|xml');

    $app->put('/dummy/v1.0/'.$type.'/{id}.{_format}', 'authbucket_push.'.$type.'_controller:updateAction')
        ->bind('dummy_'.$type.'_update')
        ->assert('_format', 'json|xml');

    $app->delete('/dummy/v1.0/'.$type.'/{id}.{_format}', 'authbucket_push.'.$type.'_controller:deleteAction')
        ->bind('dummy_'.$type.'_delete')
        ->assert('_format', 'json|xml');

    $app->get('/dummy/v1.0/'.$type.'.{_format}', 'authbucket_push.'.$type.'_controller:listAction')
        ->bind('dummy_'.$type.'_list')
        ->assert('_format', 'json|xml');
}
