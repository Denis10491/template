<?php

declare(strict_types=1);

namespace Core\Log;

use Psr\Log\AbstractLogger;
use Stringable;

class Logger extends AbstractLogger
{
    public function log($level, string|Stringable $message, array $context = []): void
    {
        $config = $this->getConfig();

        $channel = $config['channels'][$config[$level]];

        (new $channel())->send($level, $message, $context);
    }

    private function getConfig(): array
    {
        return include $_SERVER['DOCUMENT_ROOT'] . '/config/log.php';
    }

    static public function __callStatic(string $name, mixed $arguments): mixed
    {
        return (new self())->$name(...$arguments);
    }
}