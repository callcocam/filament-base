<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GeneratePagesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:generate-pages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gerar páginas para a bartir de uma base de dados';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Gerando páginas...');

         $menus = DB::connection('base')
         ->table('menus')
         ->whereNotIn('name', ['menusAdmin'])->get();

        foreach ($menus as $menu) {
            $submenus = DB::connection('base')->table('sub_menus')
            ->where('menu_id', $menu->id)->get();
             
            foreach ($submenus as $submenu) { 
                $this->info('Nome: ' . $submenu->name . '...');
                $this->error('Slug: ' . $submenu->slug . '...');
                $this->error('Link: ' . $submenu->link . '...'); 
                // $this->call('make:page', [
                //     'name' => sprintf('site.%s', $submenu->name),
                // ]);
            }
        }

        $this->info('Páginas geradas com sucesso!');
    }
}
