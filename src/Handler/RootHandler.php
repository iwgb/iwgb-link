<?php

namespace Iwgb\Link\Handler;

use Doctrine\Common\Cache\CacheProvider;
use Guym4c\Airtable\Airtable;
use Guym4c\TypeformAPI\Typeform;
use Iwgb\Link\MailgunEmailFactory;
use Pimple\Container;
use Psr\Http\Message\ServerRequestInterface;
use Siler\Http;

abstract class RootHandler {

    protected Airtable $airtable;

    protected ServerRequestInterface $request;

    protected CacheProvider $cache;

    protected MailgunEmailFactory $mailgun;

    protected Typeform $typeform;

    protected array $settings;

    public function __construct(Container $c) {
        $this->airtable = $c['airtable'];
        $this->request = $c['request'];
        $this->cache = $c['cache'];
        $this->mailgun = $c['mailgun'];
        $this->typeform = $c['typeform'];
        $this->settings = $c['settings'];
    }

    abstract public function __invoke(array $routeParams): void;

    protected function renderNotFound(): void {
        self::notFound($this->settings);
    }

    public static function notFound(array $settings): void {
        Http\redirect($settings['defaultUrl']);
    }

}