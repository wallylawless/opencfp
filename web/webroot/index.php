<?php
$loader = require_once __DIR__ . '/../../vendor/autoload.php';
$loader->add('App', dirname(__DIR__));

use Silex\Application;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\FormServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\SecurityServiceProvider;
use Symfony\Component\Security\Core\Encoder\PlaintextPasswordEncoder;
use Orlex\ServiceProvider;
use Silex\Provider\TwigServiceProvider;

$app = new Application();

require_once __DIR__ . "/../config/app.php";

$app_dir = realpath(__DIR__ . '/../app');

$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new TranslationServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new UrlGeneratorServiceProvider());

$app->register(new SecurityServiceProvider(), [ 
    'security.firewalls' => [
        'admin' => [
            'pattern' => '^/',
            'form'    => array(
                'login_path'         => '/login',
                'check_path'         => '/login_check',
                'username_parameter' => 'form[username]',
                'password_parameter' => 'form[password]',
            ),
            'logout'    => true,
            'anonymous' => true,
            'users'     => $app['security.users'],
        ],
    ],
]);

$app['security.encoder.digest'] = $app->share(function ($app) {
    return new PlaintextPasswordEncoder();
});

$app->register(new ServiceProvider(), [
    'orlex.cache.dir'       => $app['cache.path'] . '/orlex',
    'orlex.controller.dirs' => [$app_dir.'/controllers'],
    //'orlex.annotation.dirs' => [$app_dir.'/annotation'],
]);

$app->register(new TwigServiceProvider(), [
    'twig.path' => realpath(__DIR__ . "/../templates"),
]);

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
