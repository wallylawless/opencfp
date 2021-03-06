<?php
$app['env'] = getenv('APP_ENV') ?: 'prod';

$app['debug'] = $app['env'] === 'dev';

$app['cache.path'] = realpath(__DIR__ . '/../../tmp/cache');

$app['assetic.enabled']              = true;
$app['assetic.path_to_cache']        = $app['cache.path'] . '/assetic';
$app['assetic.path_to_web']          = __DIR__ . '/../webroot/assets';
$app['assetic.input.path_to_assets'] = __DIR__ . '/../assets';
$app['assetic.input.path_to_less']   = $app['assetic.input.path_to_assets'] . '/less/*.less';
$app['assetic.input.path_to_css']    = $app['assetic.input.path_to_assets'] . '/css/*.css';
$app['assetic.input.path_to_js']     = $app['assetic.input.path_to_assets'] . '/js/*.js';
$app['assetic.output.path_to_css']   = 'css/styles.css';
$app['assetic.output.path_to_js']    = 'js/scripts.js';

$app['security.users'] = array('username' => array('ROLE_USER', 'password'));
