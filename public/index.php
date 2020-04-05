<?php

$c = require '../bootstrap.php';

use Iwgb\Link\Handler;
use Siler\Container as Router;
use Siler\Http as HttpResponse;
use Siler\Route as http;

http\get('/create', fn() => HttpResponse\redirect($c['settings']['form']['create']));
http\get('/delete', fn() => HttpResponse\redirect($c['settings']['form']['delete']));

http\post('/api/callback/typeform/{operation}', new Handler\TypeformCallback($c));

http\get('/api/callback/token/{token}', new Handler\TokenCallback($c));

http\get('/api/health', new Handler\Health($c));

http\get('/{slug}', new Handler\ShortlinkHandler($c));

if (!Router\get(http\DID_MATCH, false)) {
    Handler\RootHandler::notFound($c['settings']);
}
