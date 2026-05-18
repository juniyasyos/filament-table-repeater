# Migration & Upgrade Guide - v3.x → v3.x+

## ⚡ Important: 100% Backwards Compatible

**No breaking changes!** Your existing code will continue to work without modifications.

This upgrade adds new features and improvements while maintaining full compatibility with previous versions.

---

## 🚀 Quick Upgrade Steps

### Step 1: Update Package
```bash
composer update awcodes/filament-table-repeater
```

### Step 2: Install Assets (Optional but Recommended)
```bash
php artisan table-repeater:install
```

This publishes:
- Configuration file (`config/table-repeater.php`)
- CSS/Assets
- Views
- Translations

### Step 3: No Migration Needed!
Your existing components will work as-is. Enjoy the new features when ready.

---

## 📖 What's New & How to Use

### 1. Configuration File

**New:** `config/table-repeater.php` is now available

**To publish it:**
```bash
php artisan table-repeater:config
```

**To use it:**
```php
// In your components
if (config('table-repeater.features.clone_enabled')) {
    $repeater->itemsCloneable();
}

// Or use helpers
if (table_repeater_feature_enabled('reorder_enabled')) {
    $repeater->itemsReorderable();
}
```

### 2. Global Helper Functions

**New:** Six global helper functions available

**Before:**
```php
use Juniyasyos\TableRepeater\Components\TableRepeater;
use Juniyasyos\TableRepeater\Header;

TableRepeater::make('items');
Header::make('name');
```

**After (new way, still works with old way):**
```php
table_repeater('items');
make_header('name');
table_repeater_config('styling');
table_repeater_feature_enabled('clone_enabled');
```

### 3. Builder Pattern

**New:** Fluent builders for complex configurations

**Before:**
```php
TableRepeater::make('users')
    ->headers([
        Header::make('name'),
        Header::make('email'),
    ])
    ->schema([
        TextInput::make('name'),
        TextInput::make('email'),
    ]);
```

**After (new way, old way still works):**
```php
use Juniyasyos\TableRepeater\Builders\TableRepeaterBuilder;
use Juniyasyos\TableRepeater\Builders\HeaderBuilder;

TableRepeaterBuilder::make('users')
    ->withHeaders([
        HeaderBuilder::make('name')->required()->build(),
        HeaderBuilder::make('email')->required()->build(),
    ])
    ->withSchema([...])
    ->fullFeatured()
    ->build();
```

### 4. Macro Shortcuts

**New:** Convenient macros for common patterns

```php
// Minimal setup
TableRepeater::make('items')->minimal()

// Full featured
TableRepeater::make('items')->fullFeatured()

// Compact UI
TableRepeater::make('items')->compact()

// Read-only
TableRepeater::make('items')->readOnly()

// Mobile responsive
TableRepeater::make('items')->mobileResponsive()
```

### 5. Expanded Header Methods

**New:** Additional header configuration options

```php
Header::make('email')
    ->label('Email')
    ->width('200px')
    ->required()
    ->sortable()        // NEW
    ->filterable()      // NEW
    ->icon('heroicon-m-envelope')  // NEW
    ->tooltip('User email')         // NEW
    ->helpText('Required field')    // NEW
    ->exportable()      // NEW
```

### 6. Facade Access

**New:** Access functionality via Facade

```php
use Juniyasyos\TableRepeater\Facades\TableRepeater;

// Create components
TableRepeater::make('items')
TableRepeater::builder('users')

// Access headers
TableRepeater::makeHeader('name')
TableRepeater::headerBuilder('email')

// Configuration
TableRepeater::config('styling')
TableRepeater::isFeatureEnabled('reorder_enabled')
```

### 7. Component Generation

**New:** Generate component stubs via Artisan

```bash
# Generate component only
php artisan table-repeater:stub UserContacts

# Generate component with test
php artisan table-repeater:stub ProductRepeater --test
```

This creates:
- `app/Forms/Components/UserContacts.php`
- Optionally: `tests/Feature/Forms/Components/UserContactsTest.php`

### 8. Artisan Commands

**New:** Three new commands available

```bash
# Install everything (config, assets, views, lang)
php artisan table-repeater:install

# Publish only config
php artisan table-repeater:config

# Generate component
php artisan table-repeater:stub ComponentName [--test]
```

---

## 🔄 Migration Paths

### Scenario 1: Keep Your Existing Code (No Changes)

**Your current code:** ✅ **Still works perfectly**

```php
// Old code - still works!
TableRepeater::make('items')
    ->headers([Header::make('name')])
    ->schema([...]);
```

**No migration needed!**

---

### Scenario 2: Gradually Adopt New Features

**Step-by-step migration:**

**Step 1:** Start using helpers where convenient
```php
// Old
TableRepeater::make('items')

// New (same result)
table_repeater('items')
```

**Step 2:** Use macros for simpler setup
```php
// Old
TableRepeater::make('items')
    ->streamlined(true)
    ->showLabels(false)

// New
TableRepeater::make('items')->minimal()
```

**Step 3:** Use builders for complex components
```php
// Old
TableRepeater::make('users')
    ->headers([Header::make('name'), Header::make('email')])
    ->schema([...])
    ->itemsAddable(true)
    ->itemsDeleteable(true)
    ->itemsReorderable(true)
    ->itemsCloneable(true);

// New
TableRepeaterBuilder::make('users')
    ->withHeaders([...])
    ->withSchema([...])
    ->fullFeatured()
    ->build();
```

---

### Scenario 3: Full Modern Architecture

**Refactor to use modern patterns:**

```php
// Separate concerns
namespace App\Forms\Components;

use Juniyasyos\TableRepeater\Builders\TableRepeaterBuilder;
use Juniyasyos\TableRepeater\Builders\HeaderBuilder;
use Filament\Forms\Components\TextInput;

class UserTableRepeater
{
    public static function create()
    {
        return TableRepeaterBuilder::make('users')
            ->withHeaders([
                HeaderBuilder::make('name')
                    ->label('Full Name')
                    ->required()
                    ->width('200px')
                    ->build(),
                HeaderBuilder::make('email')
                    ->label('Email Address')
                    ->required()
                    ->width('250px')
                    ->build(),
            ])
            ->withSchema([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
            ])
            ->fullFeatured()
            ->build();
    }
}

// Usage
UserTableRepeater::create()
```

---

## 📝 Common Upgrade Scenarios

### Upgrade Scenario A: Simple Form
```php
// Before
public function getForm(): Form
{
    return Form::make()
        ->schema([
            TableRepeater::make('items')
                ->headers([
                    Header::make('name')->label('Name'),
                ])
                ->schema([
                    TextInput::make('name'),
                ])
        ]);
}

// After (Optional - old code still works!)
// Use macros for cleaner code
public function getForm(): Form
{
    return Form::make()
        ->schema([
            table_repeater('items')
                ->headers([make_header('name')])
                ->schema([TextInput::make('name')])
                ->mobileResponsive()
        ]);
}
```

### Upgrade Scenario B: Complex Form
```php
// Before - verbose
$repeater = TableRepeater::make('products')
    ->headers([
        Header::make('name')->label('Name'),
        Header::make('price')->label('Price'),
        Header::make('quantity')->label('Qty'),
    ])
    ->schema([
        TextInput::make('name')->required(),
        TextInput::make('price')->numeric()->required(),
        TextInput::make('quantity')->numeric()->required(),
    ])
    ->itemsAddable(true)
    ->itemsDeletable(true)
    ->itemsReorderable(true)
    ->itemsCloneable(true);

// After - using builder
$repeater = TableRepeaterBuilder::make('products')
    ->withHeaders([
        HeaderBuilder::make('name')->label('Name')->required()->build(),
        HeaderBuilder::make('price')->label('Price')->required()->build(),
        HeaderBuilder::make('quantity')->label('Qty')->required()->build(),
    ])
    ->withSchema([
        TextInput::make('name')->required(),
        TextInput::make('price')->numeric()->required(),
        TextInput::make('quantity')->numeric()->required(),
    ])
    ->fullFeatured()
    ->build();
```

---

## 🆘 Troubleshooting

### Issue: Helpers not working
```bash
# Solution
composer dump-autoload
```

### Issue: Config not loading
```bash
# Solution
php artisan config:cache --no-interaction
```

### Issue: Commands not visible
```bash
# Solution
php artisan cache:clear
php artisan route:cache
```

### Issue: Old code stopped working
**This shouldn't happen (100% backwards compatible)**, but if it does:

1. Clear cache: `php artisan cache:clear`
2. Dump autoload: `composer dump-autoload`
3. Verify ServiceProvider is loaded
4. Check `config/app.php` providers list

---

## 📊 Before & After Comparison

| Task | Before | After |
|------|--------|-------|
| Create simple repeater | 4 lines | 1 line (helper) |
| Create full-featured | 8 lines | 1 line (macro) |
| Complex setup | Verbose | Clean builder |
| Generate component | Manual | `php artisan table-repeater:stub` |
| Configuration | Hardcoded | `config/table-repeater.php` |
| Global access | Not available | Via helpers |
| Facades | Not available | ✅ Available |

---

## 🎯 Recommended Upgrade Path

### For New Projects
1. Use builders from the start
2. Leverage macros
3. Use helpers
4. Follow the patterns in QUICKSTART.md

### For Existing Projects
1. Keep current code as-is
2. New features → Use builders
3. Refactor gradually (no rush)
4. Read ENHANCEMENTS.md when needed

### For Large Codebases
1. Update package
2. Run `php artisan table-repeater:install`
3. Generate new components with stubs
4. Refactor one form at a time
5. Use builders for new complex features

---

## ✅ Upgrade Checklist

- [ ] Run `composer update awcodes/filament-table-repeater`
- [ ] Run `php artisan table-repeater:install`
- [ ] Review `config/table-repeater.php`
- [ ] Test existing components (should work as-is)
- [ ] Read QUICKSTART.md for new patterns
- [ ] Gradually adopt new features
- [ ] Update team documentation

---

## 📚 Learning Resources

1. **QUICKSTART.md** - Get started in 5 minutes
2. **ENHANCEMENTS.md** - Full feature documentation
3. **config/table-repeater.php** - Configuration options
4. **Example components** - Check this file for patterns

---

## 🎊 You're All Set!

The upgrade is complete. Your existing code works perfectly, and you can now enjoy:
- ✅ Helper functions
- ✅ Builder pattern
- ✅ Macros
- ✅ Configuration
- ✅ Artisan commands
- ✅ Component generation

**Have fun with the new features! 🚀**

---

**Questions?** Check the documentation or create an issue on GitHub.

**Happy coding!**
