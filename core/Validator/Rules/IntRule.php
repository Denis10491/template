<?php

declare(strict_types=1);

namespace Core\Validator\Rules;

class IntRule
{
    public function __invoke(mixed $value): bool
    {
        return is_int($value);
    }
}