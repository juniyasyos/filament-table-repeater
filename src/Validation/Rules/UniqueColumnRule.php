<?php

namespace Juniyasyos\TableRepeater\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueColumnRule implements Rule
{
    protected string $message = 'The :attribute must be unique in the table.';

    protected array $values = [];

    public function __construct(protected string $column = 'id')
    {
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value): bool
    {
        if (in_array($value, $this->values)) {
            return false;
        }

        $this->values[] = $value;

        return true;
    }

    /**
     * Get the validation error message.
     */
    public function message(): string
    {
        return $this->message;
    }

    /**
     * Set custom message
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
