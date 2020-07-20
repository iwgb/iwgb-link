<?php

use Iwgb\Link\Provider;

define('APP_ROOT', __DIR__);

require APP_ROOT . '/vendor/autoload.php';

return (new \Pimple\Container([
    'settings' => require APP_ROOT . '/settings.php',
]))->register(new Provider\AirtableProvider())
    ->register(new Provider\DoctrineCacheProvider())
    ->register(new Provider\DiactorosPsr7Provider())
    ->register(new Provider\SpacesCdnProvider());
