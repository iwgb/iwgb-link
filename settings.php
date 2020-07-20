<?php

$keys = require APP_ROOT . '/keys.php';

return [
    'airtable'   => [
        'key'      => $keys['airtable'],
        'base'     => 'appvcEZsobrzWLmWi',
        'proxyKey' => $keys['airtableProxy'],
    ],
    'defaultUrl' => 'https://iwgb.org.uk',
    'spaces'     => [
        'credentials' => [
            'key'    => 'KOWTSWXXMKRJFEXMSIGK',
            'secret' => $keys['spaces'],
        ],
        'region'      => 'ams3',
        'bucket'      => 'iwgb',
        'cdnUrl'      => 'https://cdn.iwgb.org.uk',
        'publicRoot'  => 'bucket/',
    ],
];