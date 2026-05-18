<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Styling Configuration
    |--------------------------------------------------------------------------
    */
    'styling' => [
        'header_bg' => 'gray-100',
        'header_text' => 'gray-300',
        'header_bg_dark' => 'gray-900/60',
        'border_color' => 'gray-950/5',
        'border_color_dark' => 'white/20',
        'streamlined_mode' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Breakpoints & Responsive
    |--------------------------------------------------------------------------
    */
    'breakpoints' => [
        'stack_at' => 'md',
        'responsive_enabled' => true,
        'mobile_stack' => 'flex-col',
    ],

    /*
    |--------------------------------------------------------------------------
    | Features & Functionality
    |--------------------------------------------------------------------------
    */
    'features' => [
        'item_numbers' => true,
        'actions_enabled' => true,
        'reorder_enabled' => true,
        'clone_enabled' => true,
        'delete_enabled' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Localization
    |--------------------------------------------------------------------------
    */
    'localization' => [
        'namespace' => 'table-repeater',
        'supported_locales' => ['en', 'ar', 'he', 'hu', 'id', 'kk', 'nl', 'pl', 'ru'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Action Configuration
    |--------------------------------------------------------------------------
    */
    'actions' => [
        'add_button_icon' => 'heroicon-m-plus',
        'delete_button_icon' => 'heroicon-m-trash-2',
        'clone_button_icon' => 'heroicon-m-document-duplicate',
        'reorder_button_icon' => 'heroicon-m-arrows-up-down',
        'move_up_icon' => 'heroicon-m-arrow-up',
        'move_down_icon' => 'heroicon-m-arrow-down',
    ],

    /*
    |--------------------------------------------------------------------------
    | Publishing Assets
    |--------------------------------------------------------------------------
    */
    'publish' => [
        'views' => true,
        'config' => true,
        'assets' => true,
        'lang' => true,
    ],
];
