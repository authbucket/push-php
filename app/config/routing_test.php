<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/routing_dev.php';

$app->post('/dummy/v1.0/push/register', 'authbucket_push.push_controller:registerAction')
    ->bind('api_push_register');

$app->post('/dummy/v1.0/push/unregister', 'authbucket_push.push_controller:unregisterAction')
    ->bind('api_push_unregister');

$app->post('/dummy/v1.0/push/send', 'authbucket_push.push_controller:sendAction')
    ->bind('api_push_send');

foreach (array('service', 'device', 'message') as $type) {
    $app->post('/dummy/v1.0/'.$type.'.{_format}', 'authbucket_push.'.$type.'_controller:createAction')
        ->bind('api_'.$type.'_create')
        ->assert('_format', 'json|xml');

    $app->get('/dummy/v1.0/'.$type.'/{id}.{_format}', 'authbucket_push.'.$type.'_controller:readAction')
        ->bind('api_'.$type.'_read')
        ->assert('_format', 'json|xml');

    $app->put('/dummy/v1.0/'.$type.'/{id}.{_format}', 'authbucket_push.'.$type.'_controller:updateAction')
        ->bind('api_'.$type.'_update')
        ->assert('_format', 'json|xml');

    $app->delete('/dummy/v1.0/'.$type.'/{id}.{_format}', 'authbucket_push.'.$type.'_controller:deleteAction')
        ->bind('api_'.$type.'_delete')
        ->assert('_format', 'json|xml');

    $app->get('/dummy/v1.0/'.$type.'.{_format}', 'authbucket_push.'.$type.'_controller:listAction')
        ->bind('api_'.$type.'_list')
        ->assert('_format', 'json|xml');
}
