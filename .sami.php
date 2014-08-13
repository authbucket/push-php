<?php

use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Resources')
    ->in($dir = 'src');

$versions = GitVersionCollection::create($dir)
    ->add('develop', 'develop branch')
    ->add('master', 'master branch')
    ->addFromTags('*');

return new Sami($iterator, array(
    'theme' => 'enhanced',
    'versions' => $versions,
    'title' => 'AuthBucket\Push API',
    'build_dir' => __DIR__ . '/build/push/%version%',
    'cache_dir' => __DIR__ . '/build/cache/push/%version%',
    'include_parent_data' => false,
    'default_opened_level' => 2,
));
