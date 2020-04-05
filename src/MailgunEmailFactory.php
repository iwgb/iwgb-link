<?php

namespace Iwgb\Link;

use Mailgun\Mailgun;
use Mailgun\Model\Message\SendResponse;

class MailgunEmailFactory {

    private Mailgun $mailgun;

    private string $domain;

    private string $from;

    public function __construct(array $settings) {
        $this->mailgun = Mailgun::create("key-{$settings['key']}");
        $this->domain = $settings['domain'];
        $this->from = $settings['from'];
    }

    public function send(string $to, string $subject, string $text): SendResponse {
        return $this->mailgun->messages()->send($this->domain, [
            'to'        => $to,
            'from'      => $this->from,
            'subject'   => $subject,
            'text'      => $text,
        ]);
    }


}