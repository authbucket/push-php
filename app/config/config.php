<?php

use AuthBucket\Push\Tests\TestBundle\Entity\ModelManagerFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Doctrine\ORM\Tools\Setup;

// File where logs are written to.
$app['monolog.logfile'] = __DIR__.'/../../var/logs/'.$app['env'].'.log';

// Define SQLite DB path.
$app['db.options'] = [
    'driver' => 'pdo_sqlite',
    'path' => __DIR__.'/../../var/cache/'.$app['env'].'/.ht.sqlite',
];

// Return an instance of Doctrine ORM entity manager.
$app['doctrine.orm.entity_manager'] = $app->share(function ($app) {
    $conn = $app['dbs']['default'];
    $em = $app['dbs.event_manager']['default'];

    $driver = new AnnotationDriver(new AnnotationReader(), [__DIR__.'/../../tests/TestBundle/Entity']);
    $cache = new FilesystemCache(__DIR__.'/../../var/cache/'.$app['env']);

    $config = Setup::createConfiguration(false);
    $config->setMetadataDriverImpl($driver);
    $config->setMetadataCacheImpl($cache);
    $config->setQueryCacheImpl($cache);

    return EntityManager::create($conn, $config, $em);
});

// Return entity classes for model manager.
$app['authbucket_push.model'] = [
    'device' => 'AuthBucket\\Push\\Tests\\TestBundle\\Entity\\Device',
    'message' => 'AuthBucket\\Push\\Tests\\TestBundle\\Entity\\Message',
    'service' => 'AuthBucket\\Push\\Tests\\TestBundle\\Entity\\Service',
];

// Add model managers from ORM.
$app['authbucket_push.model_manager.factory'] = $app->share(function ($app) {
    return new ModelManagerFactory(
        $app['doctrine.orm.entity_manager'],
        $app['authbucket_push.model']
    );
});

require __DIR__.'/routing.php';
require __DIR__.'/security.php';

$app['debug'] = true;

$app['twig.path'] = [
    __DIR__.'/../../tests/TestBundle/Resources/views',
];
