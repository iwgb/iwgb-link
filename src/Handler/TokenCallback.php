<?php

namespace Iwgb\Link\Handler;

use Exception;
use Guym4c\Airtable\AirtableApiException;
use Siler\Http\Response;

class TokenCallback extends RootHandler {

    /**
     * {@inheritdoc}
     * @throws AirtableApiException
     */
    public function __invoke(array $params): void {

        try {
            $action = $this->cache->fetch($params['token']);

            if ($action === false) {
                self::fail();
                return;
            }

            $operation = $action['operation'];
            unset($action['operation']);

            switch ($operation) {
                case 'create':
                    $resources = $this->airtable->search('Shortlinks', 'Slug', $action['slug'])
                        ->getRecords();
                    if (!empty($resources)) {
                        $this->airtable->create('Shortlinks', $action);
                    } else {
                        self::fail();
                        return;
                    }
                    break;
                case 'delete':
                    $resource = $this->airtable->search('Shortlinks', 'Slug', $action['slug'])
                                    ->getRecords()[0];
                    $this->airtable->delete('Shortlinks', $resource->getId());
                    break;
            }
        } catch (Exception $e) {
            self::fail();
            return;
        }
        self::success();

        $this->airtable->flushCache();

        Response\html(file_get_contents(APP_ROOT . '/success.html'));
    }

    private static function fail(): void {
        Response\html(file_get_contents(APP_ROOT . '/failure.html'));
    }

    private static function success(): void {
        Response\html(file_get_contents(APP_ROOT . '/success.html'));
    }
}