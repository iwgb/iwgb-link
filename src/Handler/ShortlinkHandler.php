<?php

namespace Iwgb\Link\Handler;

use Aws\S3\S3Client;
use Guym4c\Airtable\AirtableApiException;
use Pimple\Container;
use Siler\Http;

class ShortlinkHandler extends RootHandler {

    private S3Client $cdn;

    public function __construct(Container $c) {
        parent::__construct($c);
        $this->cdn = $c['cdn'];
    }

    /**
     * @inheritDoc
     * @throws AirtableApiException
     */
    public function __invoke(array $params): void {
        $resource = $this->airtable->find('Shortlinks', 'Slug', $params['slug']);

        if (count($resource) > 0) {
            self::render('redirect.html', $resource[0]->URL);
            return;
        }

        if ($this->cdn->doesObjectExist(
            $this->settings['spaces']['bucket'],
            "{$this->settings['spaces']['publicRoot']}{$params['slug']}")
        ) {
            Http\redirect(
                "{$this->settings['spaces']['cdnUrl']}/{$this->settings['spaces']['publicRoot']}{$params['slug']}"
            );
            return;
        }

        $this->renderNotFound();
    }
}