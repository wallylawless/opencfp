<?php
$loader = require_once __DIR__ . '/../../vendor/autoload.php';
$loader->add('App', dirname(__DIR__));

$app = new \Silex\Application();

require_once __DIR__ . "/../config/app.php";

$app_dir = realpath(__DIR__ . '/../app');

$app->register(
    new \Orlex\ServiceProvider(),
    [
        'orlex.cache.dir'       => $app['cache.path'] . '/orlex',
        'orlex.controller.dirs' => [$app_dir.'/controllers'],
        //'orlex.annotation.dirs' => [$app_dir.'/annotation'],
    ]
);

$app->register(
    new \Silex\Provider\TwigServiceProvider(),
    [
        'twig.path' => realpath(__DIR__ . "/../templates"),
    ]
);

if (isset($app['assetic.enabled']) && $app['assetic.enabled']) {
    $app->register(new SilexAssetic\AsseticServiceProvider(), array(
        'assetic.options' => array(
            'debug'            => $app['debug'],
            'auto_dump_assets' => $app['debug'],
        )
    ));

    $app['assetic.filter_manager'] = $app->share(
        $app->extend('assetic.filter_manager', function($fm, $app) {
            $fm->set('lessphp', new Assetic\Filter\LessphpFilter());

            return $fm;
        })
    );

    $app['assetic.asset_manager'] = $app->share(
        $app->extend('assetic.asset_manager', function($am, $app) {
            $am->set('styles', new Assetic\Asset\AssetCache(
                new Assetic\Asset\AssetCollection(array(
                    new Assetic\Asset\GlobAsset(
                        $app['assetic.input.path_to_css']
                    ),
                    new Assetic\Asset\GlobAsset(
                        $app['assetic.input.path_to_less'],
                        array($app['assetic.filter_manager']->get('lessphp'))
                    ),
                )),
                new Assetic\Cache\FilesystemCache($app['assetic.path_to_cache'])
            ));
            $am->get('styles')->setTargetPath($app['assetic.output.path_to_css']);

            $am->set('scripts', new Assetic\Asset\AssetCache(
                new Assetic\Asset\GlobAsset($app['assetic.input.path_to_js']),
                new Assetic\Cache\FilesystemCache($app['assetic.path_to_cache'])
            ));
            $am->get('scripts')->setTargetPath($app['assetic.output.path_to_js']);

            return $am;
        })
    );

}


$app->run();
