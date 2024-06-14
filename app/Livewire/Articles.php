<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire;

use Livewire\Component; 
use App\Traits\HasLayout;

class Articles extends Component
{
   
    use HasLayout;

    public function mount()
    {
        $this->layoutData(['title' => 'Dashboard', 'sub_title' => 'Articles']);
    }

    public function view()
    {
        return 'livewire.articles';
    }
}
