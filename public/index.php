<?php

$c = require '../bootstrap.php';

use Iwgb\Link\Handler;
use Siler\Container as Router;
use Siler\Route as http;

http\get('/api/purge', new Handler\PurgeHandler($c));

http\get('/api/health', new Handler\Health($c));

http\get('/(?<slug>[A-z0-9-_\/\.]+)', new Handler\ShortlinkHandler($c));

if (!Router\get(http\DID_MATCH, false)) {
    Handler\RootHandler::notFound($c['settings']);
}
