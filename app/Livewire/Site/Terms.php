<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Site;

use App\Models\Term;
use Livewire\Component; 
use App\Traits\HasLayout;
use Livewire\Attributes\Computed;

class Terms extends Component
{
   
    use HasLayout;

    public function mount()
    {
        $this->layoutData(['title' => 'Dashboard', 'sub_title' => 'TERMS_TITLE_BREADCRUMP_PAGE']);
    }

    
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
