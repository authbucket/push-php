<?php

/**
 * This file is part of the authbucket/push package.
 *
 * (c) Wong Hoi Sing Edison <hswong3i@pantarei-design.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use AuthBucket\Push\Tests\TestBundle\Entity\ModelManagerFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;
use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;

require __DIR__ . '/security.php';

$app['debug'] = true;

$app['twig.path'] = array(
    __DIR__ . '/../../tests/src/AuthBucket/Push/Tests/TestBundle/Resources/views',
);

// Fake lib dev, simply use plain text encoder.
$app['security.encoder.digest'] = $app->share(function ($app) {
    return new PlaintextPasswordEncoder();
});

// Define SQLite DB path.
$app['db.options'] = array(
    'driver' => 'pdo_sqlite',
    'path' => __DIR__ . '/../cache/' . $app['env'] . '/.ht.sqlite',
);

// Return an instance of Doctrine ORM entity manager.
$app['authbucket_push.orm'] = $app->share(function ($app) {
    $conn = $app['dbs']['default'];
    $em = $app['dbs.event_manager']['default'];

    $driver = new AnnotationDriver(new AnnotationReader(), array(__DIR__ . '/../../tests/src/AuthBucket/Push/Tests/TestBundle/Entity'));

    $config = Setup::createConfiguration(false);
    $config->setMetadataDriverImpl($driver);
    $config->setMetadataCacheImpl(new ArrayCache());
    $config->setQueryCacheImpl(new ArrayCache());

    return EntityManager::create($conn, $config, $em);
});

// Return entity classes for model manager.
$app['authbucket_push.model'] = array(
    'client' => 'AuthBucket\\Push\\Tests\\TestBundle\\Entity\\Client',
);

// Add model managers from ORM.
$app['authbucket_push.model_manager.factory'] = $app->share(function ($app) {
    return new ModelManagerFactory($app['authbucket_push.orm'], $app['authbucket_push.model']);
});
