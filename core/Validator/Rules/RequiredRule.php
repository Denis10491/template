<?php

declare(strict_types=1);

namespace Core\Validator\Rules;

class RequiredRule extends Rule
{
    public function __invoke(mixed $value): bool
    {
        return isset($value);
    }
}