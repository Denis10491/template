<?php

declare(strict_types=1);

namespace Core\Validator\Rules;

class RequiredRule extends Rule
{
    /**
     * Checking that a value is not empty using isset.
     * 
     * @param mixed $value
     * 
     * @return bool
     */
    public function __invoke(mixed $value): bool
    {
        return isset($value);
    }
}