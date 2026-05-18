<?php

namespace Juniyasyos\TableRepeater\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

/**
 * @method static \Juniyasyos\TableRepeater\Components\TableRepeater make(string $name = 'items')
 * @method static \Juniyasyos\TableRepeater\Builders\TableRepeaterBuilder builder(string $name = 'items')
 * @method static \Juniyasyos\TableRepeater\Header makeHeader(string $name)
 * @method static \Juniyasyos\TableRepeater\Builders\HeaderBuilder headerBuilder(string $name)
 * @method static mixed config(string $key = null, mixed $default = null)
 * @method static string styling(string $key = null, string $default = null)
 * @method static bool isFeatureEnabled(string $feature)
 *
 * @see \Juniyasyos\TableRepeater\Support\Helpers
 */
class TableRepeater extends BaseFacade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return 'table-repeater';
    }
}

