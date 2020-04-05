<?php

namespace Iwgb\Link\Handler;

use Guym4c\TypeformAPI\Typeform;
use Ramsey\Uuid\Uuid;
use Siler\Http\Response;

class TypeformCallback extends RootHandler {

    private const TOKEN_LIFETIME = 60 * 5; // 5 minutes

    private const EMAIL_TEXT = "Hi there,\n\nPlease click the link below to %action% the shortlink %slug%:\n\n%url%\n\nThanks!\n\nbeep boop";

    public function __invoke(array $params): void {

        $operation = $params['operation'] === 'create'
            ? 'create'
            : 'delete';

        $answers = Typeform::parseWebhook($this->request, $this->settings['typeform']['webhookSecret'])
            ->formResponse->answers;

        list($email, $slug) = $answers;
        $url = $answers[2]->answer ?? '';

        if (explode('@', $email->answer)[1] !== 'iwgb.co.uk') {
            Response\no_content();
            return;
        }

        $slug = preg_replace("/[^a-z0-9\-_]/", '', $slug->answer);

        $token = Uuid::uuid4();

        $this->cache->save($token, [
            'Slug'   => $slug,
            'URL'    => $url,
            'operation' => $operation,
            'Author' => $email->answer,
        ], self::TOKEN_LIFETIME);

        $body = str_replace('%slug%', $slug, self::EMAIL_TEXT);
        $body = str_replace('%action%', $operation, $body);
        $body = str_replace('%url%', "https://iwgb.link/api/callback/token/{$token}", $body);

        $this->mailgun->send($email->answer, "{$operation} shortlink", $body);

        Response\no_content();
    }
}