<?php
// Caching
$app['cache.path'] = __DIR__ . '/../../cache';

// Assetic
$app['assetic.enabled']              = true;
$app['assetic.path_to_cache']        = $app['cache.path'] . '/assetic';
$app['assetic.path_to_web']          = __DIR__ . '/../webroot/assets';

$app['assetic.input.path_to_assets'] = __DIR__ . '/../assets';
$app['assetic.input.path_to_less']    = $app['assetic.input.path_to_assets'] . '/less/*.less';
$app['assetic.input.path_to_css']    = $app['assetic.input.path_to_assets'] . '/css/*.css';
$app['assetic.input.path_to_js']     = $app['assetic.input.path_to_assets'] . '/js/*.js';

$app['assetic.output.path_to_css']   = 'css/styles.css';
$app['assetic.output.path_to_js']    = 'js/scripts.js';
