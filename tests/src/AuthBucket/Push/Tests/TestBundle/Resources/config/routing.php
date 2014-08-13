<?php

/**
 * This file is part of the authbucket/push package.
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