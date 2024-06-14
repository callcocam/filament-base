<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Site;

use App\Livewire\Page\AbstractPage;
use App\Models\Term; 
use App\Traits\HasLayout;
use Livewire\Attributes\Computed;

class Terms extends AbstractPage
{
   
    use HasLayout;
 
    
    #[Computed()]
    public function terms()
    {
        return Term::query()->get();
    }


    public function view()
    {
        return 'livewire.site.terms';
    }
}
