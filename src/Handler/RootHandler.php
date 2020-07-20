<?php

namespace Iwgb\Link\Handler;

use Doctrine\Common\Cache\CacheProvider;
use Guym4c\Airtable\Airtable;
use Pimple\Container;
use Psr\Http\Message\ServerRequestInterface;
use Siler\Http;
use Siler\Http\Response;

abstract class RootHandler {

    protected Airtable $airtable;

    protected ServerRequestInterface $request;

    protected CacheProvider $cache;

    protected array $settings;

    public function __construct(Container $c) {
        $this->airtable = $c['airtable'];
        $this->request = $c['request'];
        $this->cache = $c['cache'];
        $this->settings = $c['settings'];
    }

    abstract public function __invoke(array $routeParams): void;

    protected function renderNotFound(): void {
        self::notFound($this->settings);
    }

    public static function notFound(array $settings): void {
        Http\redirect($settings['defaultUrl']);
    }

    protected static function render(string $fileName, string $url = ''): void {
        $html = file_get_contents(APP_ROOT . "/html/{$fileName}");
        $html = str_replace('%URL%', $url, $html);
        Response\html($html);
    }

}