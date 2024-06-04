<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Site;

use App\Models\About as ModelsAbout;
use Livewire\Component; 
use App\Traits\HasLayout;
use Livewire\Attributes\Computed;

class About extends Component
{
   
    use HasLayout;

    public function mount()
    {
        $this->layoutData(['title' => 'Dashboard', 'sub_title' => 'ABOUT_TITLE_BREADCRUMP_PAGE']);
    }

    #[Computed]
    public function abouts()
    {
        return ModelsAbout::query()->get();
    }

    public function view()
    {
        return 'livewire.site.about';
    }
}
