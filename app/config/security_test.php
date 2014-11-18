<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require __DIR__.'/security.php';

$app['security.firewalls'] = array(
    'admin' => array(
        'pattern' => '^/admin',
        'http' => true,
        'users' => $app['security.user_provider.admin'],
    ),
    'api_oauth2_debug' => array(
        'pattern' => '^/api/v1.0/oauth2/debug',
        'anonymous' => true,
    ),
    'api' => array(
        'pattern' => '^/api/v1.0',
        'oauth2_resource' => array(
            'resource_type' => 'debug_endpoint',
            'scope' => array(),
            'options' => array(
                'debug_endpoint' => '/api/v1.0/oauth2/debug',
                'cache' => false,
            ),
        ),
    ),
);
