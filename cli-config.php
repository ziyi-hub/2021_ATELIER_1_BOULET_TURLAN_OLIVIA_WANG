<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use DI\ContainerBuilder;


require __DIR__ . '/vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

/*
* Mise en commentaire car ces lignes posaient problème (03/11/2021)
if (false) { // Should be set to true in production
	$containerBuilder->enableCompilation(__DIR__ . '/var/cache');
}
*/

// Set up settings
$settings = require __DIR__ . '/config/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/config/dependencies.php';
$dependencies($containerBuilder);


// Build PHP-DI Container instance
$container = $containerBuilder->build();


return ConsoleRunner::createHelperSet($container->get(EntityManager::class));
//return ConsoleRunner::createHelperSet($container[EntityManager::class]);




