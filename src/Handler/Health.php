<?php

namespace Iwgb\Link\Handler;

use Siler\Http\Response;

class Health extends RootHandler {

    public function __invoke(array $routeParams): void {
        Response\no_content();
    }
}