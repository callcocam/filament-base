<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Console\Commands;

use App\Console\CanGenerateTranslate;
use Filament\Support\Commands\Concerns\CanIndentStrings;
use Filament\Support\Commands\Concerns\CanManipulateFiles;
use Filament\Support\Commands\Concerns\CanReadModelSchemas;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeTraductionCommand extends Command
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
    protected $signature = 'make:traduction {name}  {model} {locale=pt_BR} {type=traductions} {--model-namespace=} {--force} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new traduction file.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $locale = $this->argument('locale');
        $type = $this->argument('type');
        $force = $this->option('force');
        $model = $this->argument('model');

        if (!is_dir(lang_path())) {
            mkdir(lang_path(), 0777, true);
        }

        if (!is_dir(lang_path('vendor'))) {
            mkdir(lang_path('vendor'), 0777, true);
        }

        if (!is_dir(lang_path('vendor/filament-panels'))) {
            mkdir(lang_path('vendor/filament-panels'), 0777, true);
        }

        if (!is_dir(lang_path(sprintf('vendor/filament-panels/%s', $locale)))) {
            mkdir(lang_path(sprintf('vendor/filament-panels/%s', $locale)), 0777, true);
        }

        if (!is_dir(lang_path(sprintf('vendor/filament-panels/%s/resources', $locale)))) {
            mkdir(lang_path(sprintf('vendor/filament-panels/%s/resources', $locale)), 0777, true);
        }

        if (!is_dir(lang_path(sprintf('vendor/filament-panels/%s/resources/pages', $locale)))) {
            mkdir(lang_path(sprintf('vendor/filament-panels/%s/resources/pages', $locale)), 0777, true);
        }

        $this->createTraductionFile($name, $locale,$model, $type, $force);
    }

    protected function createTraductionFile($name, $locale, $model, $type, $force)
    {
        $modelNamespace = $this->option('model-namespace') ?? 'App\\Models';

        $file = lang_path(sprintf('vendor/filament-panels/%s/resources/pages/%s.php', $locale, $name));

        if (file_exists($file) && !$force) {
            $this->error('Traduction file already exists!');

            return;
        }
        $model =  str($modelNamespace)->append('\\')->append($model)
        ->replace('/', '\\')
        ->__toString(); 
        $replacements = [
            'formSchema' => $this->indentString( $this->getResourceFormSchema($model) , 4)
        ]; 
        $this->copyStubToApp($type, $file, $replacements);
        $this->info('Traduction file created successfully.');
    }
}
