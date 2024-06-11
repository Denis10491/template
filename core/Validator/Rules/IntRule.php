<?php

declare(strict_types=1);

namespace Core\Validator\Rules;

class IntRule
{
    /**
     * Checking that a value is a number using is_int.
     * 
     * @param mixed $value
     * 
     * @return bool
     */
    public function __invoke(mixed $value): bool
    {
        return is_int($value);
    }
}