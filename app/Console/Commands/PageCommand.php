<?php

namespace App\Console\Commands;

use App\Console\CanGenerateTranslate;
use Filament\Support\Commands\Concerns\CanIndentStrings;
use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Filament\Support\Commands\Concerns\CanReadModelSchemas;
use Illuminate\Console\Command;

class PageCommand extends Command
{
    use CanGenerateTranslate;
    use CanReadModelSchemas;
    use CanIndentStrings;
    use CanManipulateFiles;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:page {name} {type=Traductions} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new page.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating page...');

        $name = $this->argument('name');

        $type = $this->argument('type');

        $this->call('make:livewire', [
            'name' => sprintf('site.%s', $name),
        ]);

        $name = str($name)
            ->replace('.', '/')
            ->__toString();

        $locale = app()->getLocale();

        if (!is_dir(lang_path())) {
            mkdir(lang_path(), 0777, true);
        }


        if (!is_dir(lang_path($locale))) {
            mkdir(lang_path($locale), 0777, true);
        }

        $force = $this->option('force');

        $this->createTraductionFile($name, $locale, $type, $force);
    }

    protected function createTraductionFile($name, $locale, $type,  $force = false)
    {
        $this->info('Creating traduction file...');
        $file = lang_path(sprintf('%s/pages/site/%s.php', $locale, str($name)->slug()->lower()->__toString()));

        if (file_exists($file) && !$force) {
            $this->error('Traduction file already exists!');

            return;
        }

        $replacements = [
            'DummyPage' => $name,
            'DumpSlug' => str($name)->slug(),
        ];
        $this->copyStubToApp($type, $file, $replacements);
        $this->info('Traduction file created successfully.');
    }
}
