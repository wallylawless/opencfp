<?php
$loader = require_once __DIR__ . '/../../vendor/autoload.php';
$loader->add('App', dirname(__DIR__));

$app = new \Silex\Application();

$app->register(
    new \Orlex\ServiceProvider(),
    [
        'orlex.controller.dirs' => [
            realpath(__DIR__ . '/../app/controllers'),
        ],
        'orlex.annotation.dirs' => [
            realpath(__DIR__ . '/../app/annotation'),
        ],
    ]
);

$app->register(
    new \Silex\Provider\TwigServiceProvider(),
    [
        'twig.path' => realpath(__DIR__ . "/../templates"),
    ]
);

$app->run();
