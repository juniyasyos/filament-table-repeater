<?php

namespace Awcodes\TableRepeater\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class StubCommand extends Command
{
    protected $signature = 'table-repeater:stub {name : The name of the component} {--test : Generate test file as well}';

    protected $description = 'Generate a Table Repeater component stub';

    public function handle(): int
    {
        $name = $this->argument('name');
        $generateTest = $this->option('test');

        $this->generateComponent($name);

        if ($generateTest) {
            $this->generateTest($name);
        }

        $this->info("✓ Component {$name} generated successfully!");

        return self::SUCCESS;
    }

    protected function generateComponent(string $name): void
    {
        $path = app_path("Forms/Components/{$name}.php");
        $namespace = 'App\\Forms\\Components';

        $stub = $this->getStub('component.stub');
        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $name],
            $stub
        );

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $content);
        $this->line("Created: {$path}");
    }

    protected function generateTest(string $name): void
    {
        $path = base_path("tests/Feature/Forms/Components/{$name}Test.php");
        $namespace = 'Tests\\Feature\\Forms\\Components';

        $stub = $this->getStub('test.stub');
        $content = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $name],
            $stub
        );

        if (!is_dir(dirname($path))) {
            mkdir(dirname($path), 0755, true);
        }

        file_put_contents($path, $content);
        $this->line("Created: {$path}");
    }

    protected function getStub(string $stub): string
    {
        $path = __DIR__ . '/../../resources/stubs/' . $stub;

        return file_exists($path)
            ? file_get_contents($path)
            : $this->getDefaultStub($stub);
    }

    protected function getDefaultStub(string $stub): string
    {
        return match ($stub) {
            'component.stub' => $this->getComponentStub(),
            'test.stub' => $this->getTestStub(),
            default => '',
        };
    }

    protected function getComponentStub(): string
    {
        return <<<'STUB'
<?php

namespace {{ namespace }};

use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\TextInput;

class {{ class }} extends TableRepeater
{
    public static function make($name = null): static
    {
        return parent::make($name ?? 'items')
            ->headers([
                Header::make('name')->label('Name'),
                Header::make('description')->label('Description'),
            ])
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('description'),
            ])
            ->columnSpan('full');
    }
}
STUB;
    }

    protected function getTestStub(): string
    {
        return <<<'STUB'
<?php

namespace {{ namespace }};

use {{ namespace }}\{{ class }};
use Tests\TestCase;

class {{ class }}Test extends TestCase
{
    public function test_table_repeater_can_render()
    {
        $component = {{ class }}::make();

        $this->assertNotNull($component);
    }

    public function test_table_repeater_has_schema()
    {
        $component = {{ class }}::make();

        $this->assertNotEmpty($component->getChildComponents());
    }
}
STUB;
    }
}
