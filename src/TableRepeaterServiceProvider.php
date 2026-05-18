<?php

namespace Awcodes\TableRepeater;

use Awcodes\TableRepeater\Commands\ConfigCommand;
use Awcodes\TableRepeater\Commands\InstallCommand;
use Awcodes\TableRepeater\Commands\StubCommand;
use Awcodes\TableRepeater\Support\Macros;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class TableRepeaterServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('table-repeater')
            ->hasAssets()
            ->hasTranslations()
            ->hasViews()
            ->hasConfigFile()
            ->hasCommands(
                InstallCommand::class,
                StubCommand::class,
                ConfigCommand::class,
            );
    }

    public function packageBooted(): void
    {
        // Load helper functions
        $this->loadHelpersFrom(__DIR__ . '/Support/helpers.php');

        // Register macros
        Macros::register();

        // Register facade
        $this->registerFacade();

        // Publish additional assets
        $this->publishes([
            __DIR__ . '/../resources/stubs' => base_path('stubs/vendor/table-repeater'),
        ], 'table-repeater-stubs');
    }

    protected function loadHelpersFrom(string $path): void
    {
        if (file_exists($path)) {
            require_once $path;
        }
    }

    protected function registerFacade(): void
    {
        $this->app->bind('table-repeater', function () {
            return new class {
                public function make(string $name = 'items')
                {
                    return Components\TableRepeater::make($name);
                }

                public function builder(string $name = 'items')
                {
                    return \Awcodes\TableRepeater\Builders\TableRepeaterBuilder::make($name);
                }

                public function makeHeader(string $name)
                {
                    return Header::make($name);
                }

                public function headerBuilder(string $name)
                {
                    return \Awcodes\TableRepeater\Builders\HeaderBuilder::make($name);
                }

                public function config(string $key = null, mixed $default = null)
                {
                    return \Awcodes\TableRepeater\Support\Helpers::config($key, $default);
                }

                public function styling(string $key = null, string $default = null)
                {
                    return \Awcodes\TableRepeater\Support\Helpers::styling($key, $default);
                }

                public function isFeatureEnabled(string $feature)
                {
                    return \Awcodes\TableRepeater\Support\Helpers::isFeatureEnabled($feature);
                }
            };
        });
    }
}

