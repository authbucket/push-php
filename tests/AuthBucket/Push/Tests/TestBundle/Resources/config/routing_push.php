<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$app->get('/push', 'authbucket_push.tests.push_controller:indexAction')
    ->bind('push');

$app->get('/push/login', 'authbucket_push.tests.push_controller:loginAction')
    ->bind('push_login');
