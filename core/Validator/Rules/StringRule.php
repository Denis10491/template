<?php

declare(strict_types=1);

namespace Core\Validator\Rules;

class StringRule extends Rule
{
    /**
     * Checking that a value is a string using is_string.
     * 
     * @param mixed $value
     * 
     * @return bool
     */
    public function __invoke(mixed $value): bool
    {
        return is_string($value);
    }
}