<?php

use Slim\Factory\AppFactory;
use DI\ContainerBuilder;
use Slim\Views\TwigMiddleware;

require __DIR__ . '/../vendor/autoload.php';

session_start();

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

// Set up settings
$settings = require __DIR__ . '/../config/settings.php';
$settings($containerBuilder);

// Set up dependencies
$dependencies = require __DIR__ . '/../config/dependencies.php';
$dependencies($containerBuilder);


// Build PHP-DI Container instance
$container = $containerBuilder->build();


//Set view en Container
$container->set('view', function () {
    return \Slim\Views\Twig::create('../src/Vue', ['cache' => false]);
});

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();


// Ajout "Twig-View Middleware
$app->add(TwigMiddleware::createFromContainer($app));

require __DIR__ . '/../config/routes.php';

$app->run();
