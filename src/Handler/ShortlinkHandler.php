<?php

namespace Iwgb\Link\Handler;

use Guym4c\Airtable\AirtableApiException;
use Siler\Http\Response;

class ShortlinkHandler extends RootHandler {

    /**
     * @inheritDoc
     * @throws AirtableApiException
     */
    public function __invoke(array $params): void {
        $resource = $this->airtable->search('Shortlinks', 'Slug', $params['slug'])
                        ->getRecords();

        if (count($resource) > 0) {
            Response\redirect($resource[0]->URL);
        } else {
            $path = str_replace('_', '/', $params['slug']);
            Response\redirect("https://cdn.iwgb.org.uk/bucket/{$path}");
        }
    }
}