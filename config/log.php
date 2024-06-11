<?php

use Core\Log\Channels\SysChannel;
use Core\Log\Channels\TelegramChannel;

return [
    /**
     * =========================================
     * Main channel for logs
     * =========================================
     */
    'critical' => getenv('LOG_CHANNEL_DEFAULT'),

    /**
     * =========================================
     * List of all existing log channels
     * =========================================
     */
    'channels' => [
        'telegram' => TelegramChannel::class,
    ]
];
