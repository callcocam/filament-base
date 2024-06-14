<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Site;

use App\Livewire\Page\AbstractPage; 
use App\Traits\HasLayout;
use Illuminate\Support\Facades\Route;

class Dashboard extends AbstractPage
{
   
    use HasLayout;

    public function mount()
    {
        $this->layoutData(['title' => 'Dashboard', 'sub_title' => 'Dashboard']);
    }

    public static function route()
    {
        Route::get('/', static::class)->name(sprintf("%s.index", static::getNavigationRoute()));
    }


    public function view()
    {
        return 'livewire.site.dashboard';
    }
}
