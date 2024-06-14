<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire;

use Livewire\Component; 
use App\Traits\HasLayout;

class Article extends Component
{
   
    use HasLayout;

    public function mount()
    {
        $this->layoutData(['title' => 'Dashboard', 'sub_title' => 'Article']);
    }

    public function view()
    {
        return 'livewire.article';
    }
}
