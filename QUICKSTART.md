# Quick Start Guide - Table Repeater v3.x+

## Installation & Setup

```bash
# Install the package
composer require awcodes/filament-table-repeater

# Run installation command
php artisan table-repeater:install
```

This will:
✓ Publish configuration to `config/table-repeater.php`
✓ Publish CSS/assets
✓ Publish views
✓ Publish translations

## 5-Minute Examples

### Example 1: Simple Table Repeater
```php
use Juniyasyos\TableRepeater\Components\TableRepeater;
use Juniyasyos\TableRepeater\Header;
use Filament\Forms\Components\TextInput;

TableRepeater::make('contacts')
    ->headers([
        Header::make('name')->label('Name'),
        Header::make('email')->label('Email'),
    ])
    ->schema([
        TextInput::make('name')->required(),
        TextInput::make('email')->email()->required(),
    ])
    ->columnSpan('full');
```

### Example 2: Using Helpers (Fastest)
```php
table_repeater('items')
    ->headers([
        make_header('name'),
        make_header('email')->required(),
    ])
    ->schema([...])
    ->columnSpan('full');
```

### Example 3: Using Builders (Most Control)
```php
use Juniyasyos\TableRepeater\Builders\TableRepeaterBuilder;
use Juniyasyos\TableRepeater\Builders\HeaderBuilder;

TableRepeaterBuilder::make('products')
    ->withHeaders([
        HeaderBuilder::make('name')
            ->label('Product Name')
            ->width('250px')
            ->required()
            ->build(),
        HeaderBuilder::make('price')
            ->label('Price')
            ->alignEnd()
            ->build(),
    ])
    ->withSchema([
        TextInput::make('name')->required(),
        TextInput::make('price')->numeric()->required(),
    ])
    ->fullFeatured()
    ->build();
```

### Example 4: Using Macros (Quick Setup)
```php
// Full featured
TableRepeater::make('users')->fullFeatured()

// Minimal (no labels, streamlined)
TableRepeater::make('items')->minimal()

// Compact
TableRepeater::make('products')->compact()

// Read-only display
TableRepeater::make('orders')->readOnly()
```

### Example 5: Advanced Header Configuration
```php
Header::make('email')
    ->label('Email Address')
    ->width('200px')
    ->align('center')
    ->required()              // Mark as required with asterisk
    ->sortable()              // Enable sorting
    ->filterable()            // Enable filtering
    ->icon('heroicon-m-envelope')
    ->tooltip('User contact email')
    ->helpText('Must be valid email')
    ->exportable()            // Include in exports
```

### Example 6: Using Configuration
```php
// In config/table-repeater.php
return [
    'features' => [
        'item_numbers' => true,
        'clone_enabled' => true,
        'reorder_enabled' => true,
    ],
];

// In your form
if (table_repeater_feature_enabled('clone_enabled')) {
    $repeater->itemsCloneable();
}

// Access any config
$headerBg = config('table-repeater.styling.header_bg');
```

### Example 7: Generate Component Stub
```bash
# Generate component
php artisan table-repeater:stub UserContacts

# Generate with test
php artisan table-repeater:stub ProductRepeater --test
```

This creates:
- `app/Forms/Components/UserContacts.php`
- `tests/Feature/Forms/Components/UserContactsTest.php`

## Common Patterns

### Pattern 1: Minimal Table
```php
table_repeater('items')
    ->minimal()  // Streamlined, no labels
    ->schema([
        TextInput::make('name'),
        TextInput::make('value'),
    ]);
```

### Pattern 2: Full-Featured Admin Table
```php
TableRepeater::make('admin_items')
    ->headers([
        Header::make('id')->label('#')->width('80px'),
        Header::make('name')->label('Name')->sortable(),
        Header::make('email')->label('Email')->filterable(),
        Header::make('status')->label('Status'),
    ])
    ->schema([...])
    ->fullFeatured();  // Add/Delete/Reorder/Clone
```

### Pattern 3: Display-Only Table
```php
table_repeater('view_only')
    ->headers([
        make_header('name'),
        make_header('email'),
    ])
    ->schema([...])
    ->readOnly();  // No actions, disabled
```

### Pattern 4: Compact Mobile-Friendly
```php
TableRepeater::make('mobile_items')
    ->compact()  // Streamlined UI
    ->mobileResponsive()
    ->headers([...])
    ->schema([...]);
```

## Using Facades

```php
use Juniyasyos\TableRepeater\Facades\TableRepeater;

// Create component
TableRepeater::make('users')

// Create builder
TableRepeater::builder('products')

// Create header
TableRepeater::makeHeader('email')

// Access config
TableRepeater::config('styling')
TableRepeater::isFeatureEnabled('reorder_enabled')
```

## Tips & Tricks

### Tip 1: Reusable Headers
```php
class CommonHeaders
{
    public static function email(): Header
    {
        return Header::make('email')
            ->label('Email')
            ->width('200px')
            ->required();
    }

    public static function name(): Header
    {
        return Header::make('name')
            ->label('Name')
            ->width('180px')
            ->required();
    }
}

// Usage
TableRepeater::make('users')
    ->headers([
        CommonHeaders::name(),
        CommonHeaders::email(),
    ]);
```

### Tip 2: Conditional Configuration
```php
$repeater = TableRepeater::make('items');

if (auth()->user()->isAdmin()) {
    $repeater->itemsCloneable()
        ->itemsReorderable();
}

if (app()->environment('production')) {
    $repeater->itemsAddable(false)
        ->itemsDeletable(false);
}
```

### Tip 3: Responsive Headers
```php
Header::make('actions')
    ->label('Actions')
    ->width(app()->environment('local') ? '300px' : '100px')
```

## Validation Example

```php
use Juniyasyos\TableRepeater\Validation\TableRepeaterValidator;

// Validate all rows
$rows = request('items');
$validator = TableRepeaterValidator::validateRows($rows, [
    'name' => 'required|string|max:255',
    'email' => 'required|email',
    'phone' => 'nullable|regex:/^[0-9\+\-\s]+$/',
]);

if ($validator->fails()) {
    return back()->withErrors($validator);
}
```

## Troubleshooting

**Q: Helpers not working?**
```bash
composer dump-autoload
```

**Q: Config not loading?**
```bash
php artisan config:cache --no-interaction
```

**Q: Commands not appearing?**
```bash
php artisan cache:clear
php artisan route:cache --no-interaction
```

## Next Steps

1. Read [ENHANCEMENTS.md](ENHANCEMENTS.md) for detailed documentation
2. Check [README.md](README.md) for usage examples
3. Explore `config/table-repeater.php` for customization
4. Use `php artisan table-repeater:stub` to generate stubs

## Support

For issues or questions:
1. Check documentation
2. Review examples in this guide
3. Check existing issues on GitHub
4. Create a new issue with details

Happy coding! 🚀
