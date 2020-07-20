<?php

namespace Iwgb\Link\Handler;

class PurgeHandler extends RootHandler {

    public function __invoke(array $routeParams): void {
        $this->airtable->flushCache();
        self::render('purged.html');
        return;
    }
}