<?php

namespace Juniyasyos\TableRepeater\Support;

use Juniyasyos\TableRepeater\Components\TableRepeater;
use Juniyasyos\TableRepeater\Header;

class Helpers
{
    /**
     * Create a new Table Repeater component
     */
    public static function makeTableRepeater(string $name = 'items'): TableRepeater
    {
        return TableRepeater::make($name);
    }

    /**
     * Create a new Header
     */
    public static function makeHeader(string $name): Header
    {
        return Header::make($name);
    }

    /**
     * Get Table Repeater configuration
     */
    public static function config(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return config('table-repeater', []);
        }

        return config('table-repeater.' . $key, $default);
    }

    /**
     * Get styling configuration
     */
    public static function styling(?string $key = null, ?string $default = null): string
    {
        $styling = config('table-repeater.styling', []);

        if ($key === null) {
            return '';
        }

        return $styling[$key] ?? $default ?? '';
    }

    /**
     * Get features configuration
     */
    public static function isFeatureEnabled(string $feature): bool
    {
        return config('table-repeater.features.' . $feature, true);
    }

    /**
     * Get action icon configuration
     */
    public static function actionIcon(string $action): string
    {
        return config('table-repeater.actions.' . $action . '_icon', '');
    }
}
