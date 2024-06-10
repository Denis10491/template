<?php

declare(strict_types=1);

namespace Core\Validator;

use Core\Validator\Rules\IntRule;
use Core\Validator\Rules\RequiredRule;
use Core\Validator\Rules\Rule;
use Core\Validator\Rules\StringRule;
use InvalidArgumentException;

trait Validator
{
    protected array $rules = [
        'required' => RequiredRule::class,
        'int' => IntRule::class,
        'string' => StringRule::class,
    ];

    public function __invoke(array $checks): void
    {
        foreach($checks as $variableName => $rules) {
            if (!isset($this->$variableName)) {
                throw new InvalidArgumentException();
            }

            foreach($rules as $ruleKey) {
                $rule = $this->getRule($ruleKey);
                $rule($this->$variableName);
            }
        }
    }

    protected function getRule(string $key): Rule
    {
        $rule = $this->rules[$key];

        return new $rule();
    }
}