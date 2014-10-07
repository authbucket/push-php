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

$app['security.user_provider.default'] = $app['security.user_provider.inmemory._proto'](array(
    'demousername1' => array('ROLE_USER', 'demopassword1'),
    'demousername2' => array('ROLE_USER', 'demopassword2'),
    'demousername3' => array('ROLE_USER', 'demopassword3'),
));

$app['security.user_provider.admin'] = $app['security.user_provider.inmemory._proto'](array(
    'admin' => array('ROLE_ADMIN', 'secrete'),
));

$app['security.firewalls'] = array(
    'admin' => array(
        'pattern' => '^/admin',
        'http' => true,
        'users' => $app['security.user_provider.admin'],
    ),
    'api' => array(
        'pattern' => '^/api/v1.0',
        'http' => true,
        'users' => $app['security.user_provider.default'],
    ),
);
