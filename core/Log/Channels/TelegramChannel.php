<?php

declare(strict_types=1);

namespace Core\Log\Channels;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Stringable;

class TelegramChannel extends LoggerChannel
{
    public function send($level, string|Stringable $message, array $context = []): void
    {
        $client = new Client();

        $client->post('https://api.telegram.org/bot'. getenv('LOG_TELEGRAM_TOKEN') .'/sendMessage', [
            RequestOptions::JSON => [
                'chat_id' => getenv('LOG_TELEGRAM_USER_ID'),
                'text' => strtoupper($level) .': '. $message,
            ]
        ]);
    }
}