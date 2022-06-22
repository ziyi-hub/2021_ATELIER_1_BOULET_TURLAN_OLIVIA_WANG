<?php
declare(strict_types=1);
use DI\ContainerBuilder; 


return function (ContainerBuilder $containerBuilder) {
// Global Settings Object
$containerBuilder->addDefinitions([
    'settings' => [
        'doctrine' => [
            'dev_mode' => true,
            'cache_dir' => __DIR__.'/../var/cache/doctrine',
            'metadata_dirs' => [__DIR__.'/../src/Entity/'],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'mysql',
                'port' => 3306,
                'dbname' => 'atelier',
                'user' => 'btow',
                'password' => 'btow',
                ]
            ],
        'twig' => [
            'paths' => [
                __DIR__ .'/../src/Vue'
                ],
            'options' => [
                'cache_enabled' => false,
                'cache_path' => __DIR__ . '/../var/twig',
                ]
            ]
        ]
    ]);
};
