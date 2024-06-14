<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Site;

use Livewire\Component; 
use App\Traits\HasLayout;

class Dashboard extends Component
{
   
    use HasLayout;

    public function mount()
    {
        $this->layoutData(['title' => 'Dashboard', 'sub_title' => 'Dashboard']);
    }

    public function view()
    {
        return 'livewire.site.dashboard';
    }
}
