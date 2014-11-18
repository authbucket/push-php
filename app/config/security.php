<?php

/**
 * This file is part of the authbucket/push-php package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;

$app['security.encoder.digest'] = $app->share(function ($app) {
    return new PlaintextPasswordEncoder();
});

$app['security.user_provider.admin'] = $app['security.user_provider.inmemory._proto'](array(
    'admin' => array('ROLE_ADMIN', 'secrete'),
));

$app['security.firewalls'] = array(
    'admin' => array(
        'pattern' => '^/admin',
        'http' => true,
        'users' => $app['security.user_provider.admin'],
    ),
    'dummy_oauth2_debug' => array(
        'pattern' => '^/dummy/v1.0/oauth2/debug',
        'anonymous' => true,
    ),
    'dummy' => array(
        'pattern' => '^/dummy/v1.0',
        'oauth2_resource' => array(
            'resource_type' => 'debug_endpoint',
            'scope' => array(),
            'options' => array(
                'debug_endpoint' => '/dummy/v1.0/oauth2/debug',
                'cache' => false,
            ),
        ),
    ),
    'api' => array(
        'pattern' => '^/api/v1.0',
        'oauth2_resource' => array(
            'resource_type' => 'debug_endpoint',
            'scope' => array(),
            'options' => array(
                'debug_endpoint' => 'http://oauth2-php.authbucket.com/api/v1.0/oauth2/debug',
                'cache' => false,
            ),
        ),
    ),
);
