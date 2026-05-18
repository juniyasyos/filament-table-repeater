<?php

use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Awcodes\TableRepeater\Support\Helpers;

if (!function_exists('table_repeater')) {
    /**
     * Create a new Table Repeater component
     *
     * @param  string  $name
     * @return TableRepeater
     */
    function table_repeater(string $name = 'items'): TableRepeater
    {
        return Helpers::makeTableRepeater($name);
    }
}

if (!function_exists('make_header')) {
    /**
     * Create a new Header
     *
     * @param  string  $name
     * @return Header
     */
    function make_header(string $name): Header
    {
        return Helpers::makeHeader($name);
    }
}

if (!function_exists('table_repeater_config')) {
    /**
     * Get Table Repeater configuration
     *
     * @param  string|null  $key
     * @param  mixed  $default
     * @return mixed
     */
    function table_repeater_config(string $key = null, mixed $default = null): mixed
    {
        return Helpers::config($key, $default);
    }
}

if (!function_exists('table_repeater_styling')) {
    /**
     * Get Table Repeater styling value
     *
     * @param  string  $key
     * @param  string|null  $default
     * @return string
     */
    function table_repeater_styling(string $key, string $default = null): string
    {
        return Helpers::styling($key, $default);
    }
}

if (!function_exists('table_repeater_feature_enabled')) {
    /**
     * Check if a Table Repeater feature is enabled
     *
     * @param  string  $feature
     * @return bool
     */
    function table_repeater_feature_enabled(string $feature): bool
    {
        return Helpers::isFeatureEnabled($feature);
    }
}
