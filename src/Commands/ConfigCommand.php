<?php

namespace Awcodes\TableRepeater\Commands;

use Illuminate\Console\Command;

class ConfigCommand extends Command
{
    protected $signature = 'table-repeater:config';

    protected $description = 'Publish Table Repeater configuration file';

    public function handle(): int
    {
        $this->call('vendor:publish', [
            '--provider' => 'Juniyasyos\\TableRepeater\\TableRepeaterServiceProvider',
            '--tag' => 'table-repeater-config',
            '--force' => $this->option('force') ?? false,
        ]);

        $this->info('✓ Configuration published to: config/table-repeater.php');

        return self::SUCCESS;
    }
}
