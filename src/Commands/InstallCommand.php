<?php

namespace Awcodes\TableRepeater\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'table-repeater:install';

    protected $description = 'Install Table Repeater plugin and publish assets';

    public function handle(): int
    {
        $this->info('Installing Table Repeater Plugin...');
        $this->newLine();

        // Publish config
        $this->call('vendor:publish', [
            '--provider' => 'Juniyasyos\\TableRepeater\\TableRepeaterServiceProvider',
            '--tag' => 'table-repeater-config',
            '--force' => true,
        ]);

        // Publish assets
        $this->call('vendor:publish', [
            '--provider' => 'Juniyasyos\\TableRepeater\\TableRepeaterServiceProvider',
            '--tag' => 'table-repeater-assets',
            '--force' => true,
        ]);

        // Publish views
        $this->call('vendor:publish', [
            '--provider' => 'Juniyasyos\\TableRepeater\\TableRepeaterServiceProvider',
            '--tag' => 'table-repeater-views',
            '--force' => true,
        ]);

        // Publish translations
        $this->call('vendor:publish', [
            '--provider' => 'Juniyasyos\\TableRepeater\\TableRepeaterServiceProvider',
            '--tag' => 'table-repeater-lang',
            '--force' => true,
        ]);

        $this->newLine();
        $this->info('✓ Table Repeater installed successfully!');
        $this->info('✓ Configuration published to: config/table-repeater.php');
        $this->info('✓ Assets published to: public/vendor/table-repeater/');
        $this->info('✓ Views published to: resources/views/vendor/table-repeater/');
        $this->info('✓ Translations published to: resources/lang/vendor/table-repeater/');

        return self::SUCCESS;
    }
}
