<?php

namespace Awcodes\TableRepeater\Support;

use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;

class Macros
{
    /**
     * Register all macros
     */
    public static function register(): void
    {
        self::registerTableRepeaterMacros();
        self::registerHeaderMacros();
    }

    protected static function registerTableRepeaterMacros(): void
    {
        TableRepeater::macro('withDefaults', function () {
            return $this->streamlined(false)
                ->defaultItems(1)
                ->renderHeader(true);
        });

        TableRepeater::macro('minimal', function () {
            return $this->streamlined(true)
                ->showLabels(false)
                ->renderHeader(false);
        });

        TableRepeater::macro('compact', function () {
            return $this->streamlined(true)
                ->showLabels(false);
        });

        TableRepeater::macro('fullFeatured', function () {
            return $this->renderHeader(true)
                ->showLabels(true)
                ->itemsAddable(true)
                ->itemsDeletable(true)
                ->itemsReorderable(true)
                ->itemsCloneable(true);
        });

        TableRepeater::macro('readOnly', function () {
            return $this->itemsAddable(false)
                ->itemsDeletable(false)
                ->itemsReorderable(false)
                ->itemsCloneable(false)
                ->disabled(true);
        });

        TableRepeater::macro('mobileResponsive', function () {
            return $this->stackAt(config('table-repeater.breakpoints.stack_at', 'md'));
        });
    }

    protected static function registerHeaderMacros(): void
    {
        Header::macro('withDefaults', function () {
            return $this->align('start')
                ->width('auto');
        });

        Header::macro('fullWidth', function () {
            return $this->width('100%');
        });

        Header::macro('narrow', function () {
            return $this->width('80px');
        });

        Header::macro('required', function () {
            return $this->markAsRequired(true);
        });

        Header::macro('optional', function () {
            return $this->markAsRequired(false);
        });
    }
}
