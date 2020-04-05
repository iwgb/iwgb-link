<?php

$keys = require APP_ROOT . '/keys.php';

return [
    'mailgun'  => [
        'key'    => $keys['mailgun'],
        'domain' => 'mx.iwgb.org.uk',
        'from'   => 'IWGB Activist Robot <activist-robot-noreply@iwgb.org.uk>'
    ],
    'airtable' => [
        'key'      => $keys['airtable'],
        'base'     => 'appvcEZsobrzWLmWi',
        'proxyKey' => $keys['airtableProxy'],
    ],
    'typeform' => [
        'webhookSecret' => $keys['typeform']['webhook'],
        'api'           => $keys['typeform']['api'],
    ],
    'defaultUrl' => 'https://iwgb.org.uk',
    'form' => [
        'create' => 'https://iwgb.typeform.com/to/IwDK46',
        'delete' => 'https://iwgb.typeform.com/to/NHVjzg',
    ],
];