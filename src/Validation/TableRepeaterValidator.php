<?php

namespace Juniyasyos\TableRepeater\Validation;

use Illuminate\Validation\Validator;

class TableRepeaterValidator
{
    /**
     * Validate table repeater data
     */
    public static function validate(
        array $data,
        array $rules,
        array $messages = [],
        array $attributes = []
    ): Validator {
        return validator($data, $rules, $messages, $attributes);
    }

    /**
     * Validate each row in the repeater
     */
    public static function validateRows(
        array $rows,
        array $rules,
        array $messages = [],
        array $attributes = []
    ): Validator {
        $data = [];
        $rowRules = [];

        foreach ($rows as $index => $row) {
            foreach ($row as $key => $value) {
                $data["rows.{$index}.{$key}"] = $value;
                $rowRules["rows.{$index}.{$key}"] = $rules[$key] ?? [];
            }
        }

        return static::validate($data, $rowRules, $messages, $attributes);
    }

    /**
     * Make validation messages
     */
    public static function messages(): array
    {
        return [
            'required' => trans('table-repeater::validation.required'),
            'unique' => trans('table-repeater::validation.unique'),
            'email' => trans('table-repeater::validation.email'),
            'numeric' => trans('table-repeater::validation.numeric'),
            'min' => trans('table-repeater::validation.min'),
            'max' => trans('table-repeater::validation.max'),
        ];
    }

    /**
     * Make default rules
     */
    public static function defaultRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|regex:/^[0-9\+\-\s\(\)]+$/',
        ];
    }
}
