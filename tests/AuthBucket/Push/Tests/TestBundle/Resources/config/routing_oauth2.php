<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$app->match('/dummy/v1.0/oauth2/debug', 'authbucket_push.tests.oauth2_controller:debugAction')
    ->bind('dummy_oauth2_debug')
    ->method('GET|POST');
