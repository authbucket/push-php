<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$app->get('/push', 'authbucket_push.tests.push_controller:pushIndexAction')
    ->bind('push_index');

$app->get('/push/login', 'authbucket_push.tests.push_controller:pushLoginAction')
    ->bind('push_login');

$app->post('/push/device', 'authbucket_push.device_controller:deviceAction')
    ->bind('push_device');

$app->post('/push/model/{type}.{_format}', 'authbucket_push.model_controller:createModelAction')
    ->bind('push_model_type_create')
    ->assert('_format', 'json|xml');

$app->get('/push/model/{type}/{id}.{_format}', 'authbucket_push.model_controller:readModelAction')
    ->bind('push_model_type_read')
    ->assert('_format', 'json|xml');

$app->put('/push/model/{type}/{id}.{_format}', 'authbucket_push.model_controller:updateModelAction')
    ->bind('push_model_type_update')
    ->assert('_format', 'json|xml');

$app->delete('/push/model/{type}/{id}.{_format}', 'authbucket_push.model_controller:deleteModelAction')
    ->bind('push_model_type_delete')
    ->assert('_format', 'json|xml');

$app->get('/push/model/{type}.{_format}', 'authbucket_push.model_controller:listModelAction')
    ->bind('push_model_type_list')
    ->assert('_format', 'json|xml');
