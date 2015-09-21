<?php

$app['security.encoder.digest'] = $app->share(function ($app) {
    return new Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder();
});

$app['security.user_provider.admin'] = $app['security.user_provider.inmemory._proto']([
    'admin' => ['ROLE_ADMIN', 'secrete'],
]);

$app['security.firewalls'] = [
    'admin' => [
        'pattern' => '^/admin',
        'http' => true,
        'users' => $app['security.user_provider.admin'],
    ],
    'api' => [
        'pattern' => '^/api',
        'oauth2_resource' => [
            'resource_type' => 'debug_endpoint',
            'scope' => [],
            'options' => [
                'debug_endpoint' => 'http://oauth2-php.authbucket.com/api/oauth2/debug',
                'cache' => false,
            ],
        ],
    ],
];
