<?php


namespace Iwgb\Link\Provider;


use Guym4c\TypeformAPI\Typeform;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class TypeformProvider implements ServiceProviderInterface {

    /**
     * @inheritDoc
     */
    public function register(Container $c) {
        $c['typeform'] = fn(): Typeform => new Typeform($c['settings']['typeform']['api']);
    }
}