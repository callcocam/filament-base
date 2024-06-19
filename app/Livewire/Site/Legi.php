<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Site;
 
use App\Livewire\Page\AbstractPage;
use App\Traits\HasLayout;

class Legi extends AbstractPage
{
   
    use HasLayout; 

    public function view()
    {
        return 'livewire.site.legi';
    }
}
