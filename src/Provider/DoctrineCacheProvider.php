<?php

namespace Iwgb\Link\Provider;

use Doctrine\Common\Cache\CacheProvider;
use Doctrine\Common\Cache\FilesystemCache;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DoctrineCacheProvider implements ServiceProviderInterface {

    /**
     * @inheritDoc
     */
    public function register(Container $c) {
        $c['cache'] = fn (): CacheProvider => new FilesystemCache(APP_ROOT . '/var/cache/tokens');
    }
}