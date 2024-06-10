<?php

declare(strict_types=1);

namespace Core\Validator\Rules;

class StringRule extends Rule
{
    public function __invoke(mixed $value): bool
    {
        return is_string($value);
    }
}