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

    /**
     * Accepts an array of names of checks that need to be performed and runs them.
     * 
     * @param array $checks
     * 
     * @return void
     */
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

    /**
     * Allows to get a Rule by key.
     * 
     * @param string $key
     * 
     * @return Rule
     */
    protected function getRule(string $key): Rule
    {
        $rule = $this->rules[$key];

        return new $rule();
    }
}