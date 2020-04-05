<?php

namespace Iwgb\Link\Provider;

use Iwgb\Link\MailgunEmailFactory;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MailgunEmailProvider implements ServiceProviderInterface {

    /**
     * @inheritDoc
     */
    public function register(Container $c) {
        $c['mailgun'] = fn(): MailgunEmailFactory => new MailgunEmailFactory($c['settings']['mailgun']);
    }
}