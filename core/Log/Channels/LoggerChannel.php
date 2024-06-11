<?php

declare(strict_types=1);

namespace Core\Log\Channels;

abstract class LoggerChannel
{
    abstract public function send($level, string|\Stringable $message, array $context = []): void;
}