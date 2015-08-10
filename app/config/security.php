<?php

$app['security.encoder.digest'] = $app->share(function ($app) {
    return new Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder();
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
