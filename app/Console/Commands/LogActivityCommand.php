<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Filament\Facades\Filament;
use Filament\Panel;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use ReflectionClass;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\select;
use function Laravel\Prompts\suggest;
use function Laravel\Prompts\text;


class LogActivityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:log-activity-page {name?} {--R|resource=} {--T|type=} {--panel=} {--F|force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new activity log file.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $page = (string) str(
            $this->argument('name') ??
                text(
                    label: 'What is the page name?',
                    placeholder: 'UserListActivities',
                    required: true,
                ),
        )
            ->trim('/')
            ->trim('\\')
            ->trim(' ')
            ->replace('/', '\\');
        $pageClass = (string) str($page)->afterLast('\\');
        $pageNamespace = str($page)->contains('\\') ?
            (string) str($page)->beforeLast('\\') :
            '';

        $resource = null;
        $resourceClass = null;
        $resourcePage = null;

        $panel = $this->option('panel');

        if ($panel) {
            $panel = Filament::getPanel($panel);
        }

        if (!$panel) {
            $panels = Filament::getPanels();

            /** @var Panel $panel */
            $panel = (count($panels) > 1) ? $panels[select(
                label: 'Which panel would you like to create this in?',
                options: array_map(
                    fn (Panel $panel): string => $panel->getId(),
                    $panels,
                ),
                default: Filament::getDefaultPanel()->getId()
            )] : Arr::first($panels);
        }

        $resourceInput = $this->option('resource') ?? suggest(
            label: 'Which resource would you like to create this in?',
            options: collect($panel->getResources())
                ->filter(fn (string $namespace): bool => str($namespace)->contains('\\Resources\\'))
                ->map(
                    fn (string $namespace): string => (string) str($namespace)
                        ->afterLast('\\Resources\\')
                        ->beforeLast('Resource')
                )
                ->all(),
            placeholder: '[Optional] UserResource',
        );

        if (filled($resourceInput)) {
            $resource = (string) str($resourceInput)
                ->studly()
                ->trim('/')
                ->trim('\\')
                ->trim(' ')
                ->replace('/', '\\');

            if (!str($resource)->endsWith('Resource')) {
                $resource .= 'Resource';
            }

            $resourceClass = (string) str($resource)
                ->afterLast('\\');
        }


        $resourceDirectories = $panel->getResourceDirectories();
        $resourceNamespaces = $panel->getResourceNamespaces();

        $resourceNamespace = (count($resourceNamespaces) > 1) ?
            select(
                label: 'Which namespace would you like to create this in?',
                options: $resourceNamespaces
            ) : (Arr::first($resourceNamespaces) ?? 'App\\Filament\\Resources');

        $resourcePath = (count($resourceDirectories) > 1) ?
            $resourceDirectories[array_search($resourceNamespace, $resourceNamespaces)] : (Arr::first($resourceDirectories) ?? app_path('Filament/Resources/'));

        $path = (string) str($page)
            ->prepend('/')
            ->prepend($resourcePath)
            ->prepend("\\Pages\\")
            ->replace('\\', '/')
            ->replace('//', '/')
            ->append('.php');

        $this->info($resourceNamespace);
        $path = str($resourcePath)
            ->append("\\")
            ->append($resource)
            ->append("\\Pages\\")->append($pageClass)
            ->append('.php')
            ->replace('\\', '/')
            ->replace('//', '/')
            ->__toString();

        $this->copyStubToApp('ActiviteLog', $path, [
            'baseResourcePage' => 'Filament\\Resources\\Pages\\' . ($resourcePage === 'custom' ? 'Page' : $resourcePage),
            'baseResourcePageClass' => $resourcePage === 'custom' ? 'Page' : $resourcePage,
            'namespace' => "{$resourceNamespace}\\{$resource}\\Pages" . ($pageNamespace !== '' ? "\\{$pageNamespace}" : ''),
            'resource' => "{$resourceNamespace}\\{$resource}",
            'resourceClass' => $resourceClass,
            'resourcePageClass' => $pageClass,
        ]);

        $this->info('Creating a new activity log page in the ' . $panel->getId() . ' panel.'); 
        $this->table(
            ['Method', 'Value'],
            [
                ['getPages', sprintf("'activities' => Pages\%s::route('/{record}/activities'),", $pageClass)],
                ['actions', "Tables\Actions\Action::make('activities')->url(fn (\$record) => static::getUrl('activities', ['record' => \$record]))"],
                ['Resource Page', "{$resourceNamespace}\\{$resource}"], 
            ]
        ); 
    }

    /**
     * @param  array<string, string>  $replacements
     */
    protected function copyStubToApp(string $stub, string $targetPath, array $replacements = []): void
    {
        $filesystem = app(Filesystem::class);

        if (!$this->fileExists($stubPath = base_path("stubs/filament/{$stub}.stub"))) {
            $stubPath = $this->getDefaultStubPath() . "/{$stub}.stub";
        }

        $stub = str($filesystem->get($stubPath));

        foreach ($replacements as $key => $replacement) {
            $stub = $stub->replace("{{ {$key} }}", $replacement);
        }

        $stub = (string) $stub;

        $this->writeFile($targetPath, $stub);
    }

    protected function fileExists(string $path): bool
    {
        $filesystem = app(Filesystem::class);

        return $filesystem->exists($path);
    }

    protected function writeFile(string $path, string $contents): void
    {
        $filesystem = app(Filesystem::class);

        $filesystem->ensureDirectoryExists(
            pathinfo($path, PATHINFO_DIRNAME),
        );

        $filesystem->put($path, $contents);
    }

    protected function getDefaultStubPath(): string
    {
        $reflectionClass = new ReflectionClass($this);

        return (string) str($reflectionClass->getFileName())
            ->beforeLast('Commands')
            ->append('../stubs');
    }
}
