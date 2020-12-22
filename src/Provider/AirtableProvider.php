<?php

namespace Iwgb\Link\Provider;

use Doctrine\Common\Cache\FilesystemCache;
use Guym4c\Airtable\Airtable;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class AirtableProvider implements ServiceProviderInterface {

    /**
     * {@inheritdoc}
     */
    public function register(Container $c) {
        $c['airtable'] = fn (Container $c): Airtable => new Airtable(
            $c['settings']['airtable']['key'],
            $c['settings']['airtable']['base'],
            new FilesystemCache(APP_ROOT . '/var/cache/airtable'),
            ['Shortlinks'],
            'https://outbound.iwgb.org.uk/v0',
            [
                'X-Proxy-Auth' => $c['settings']['airtable']['proxyKey'],
                'X-Proxy-Destination-Key' => 'airtable',
                ],
            false
        );
    }
}