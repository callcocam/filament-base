<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Console;

use Filament\Forms;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

trait CanGenerateTranslate
{
    protected function getResourceFormSchema(string $model): string
    {
        $model = $this->getModel($model);


        if (blank($model)) {
            return '//';
        }

        $schema = $this->getModelSchema($model);
        $table = $this->getModelTable($model);

        $filesystem = app(Filesystem::class);

        $targetPath = storage_path("stubs/filament/base.json");
        if (!$this->fileExists($targetPath)) {

            $this->writeFile($targetPath, '{}');
        }

        $replacements = json_decode($filesystem->get($targetPath), true);
        $groupLabel = Str::beforeLast($model, '\\');
        $groupLabel = Str::afterLast($groupLabel, '\\');
        $output = '';
        $output .= sprintf('"modelLabel" => "%s",', class_basename($model)) . PHP_EOL;
        $output .= sprintf('"pluralModelLabel" => "%s",', Str::plural(class_basename($model))) . PHP_EOL;
        $output .= sprintf('"navigationLabel" => "%s",', Str::plural(class_basename($model))) . PHP_EOL;
        $output .= sprintf('"navigationGroup" => "%s",', Str::plural($groupLabel)) . PHP_EOL;

        $form = '';
        $columns = '';
        foreach ($schema->getColumns($table) as $column) {
            $name = (string) data_get($column, 'name');
            if (in_array($name, ['user_id', 'tenant_id', 'id', 'created_at', 'updated_at', 'deleted_at'])) {
                continue;
            }
            if (data_get($replacements, $name)) {
                $label = data_get($replacements, $name);
            } else {
                $label = Str::of($name)->replace('_', ' ')->ucfirst()->__toString();
            }


            if ($name == 'status') {
                $options = sprintf('"%s" => ["label" => "%s",%s "placeholder" => "%s",%s "options" => ["draft" => "Rascunho", "published" => "Publicado"]],', $name, $label, PHP_EOL, $label, PHP_EOL);
                $form .=  $options . PHP_EOL;
            } else {
                $form .= sprintf('"%s" => [%s],', $name, sprintf('"label" => "%s",%s "placeholder" => "%s",%s', $label, PHP_EOL, $label, PHP_EOL)) . PHP_EOL;
            }
            $columns .= sprintf('"%s" => "%s",%s', $name, $label, PHP_EOL) . PHP_EOL;
            $replacements[$name] =  $label;
        }

        $output .=  sprintf('"forms" => [%s],', $form) . PHP_EOL;
        $output .=  sprintf('"columns" => [%s],', $columns) . PHP_EOL;
        $this->copyStubToBaseApp($replacements, $targetPath, $filesystem);
        return $output;
    }

    protected function copyStubToBaseApp(array $replacements, $targetPath, $filesystem): void
    {


        foreach ($replacements as $key => $replacement) {
            $stubs[$key] = $replacement;
        }

        $this->writeFile($targetPath, json_encode($stubs, JSON_PRETTY_PRINT));
    }
}
