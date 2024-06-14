<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Site;

use App\Livewire\Page\AbstractPage;
use App\Models\About as ModelsAbout; 
use App\Traits\HasLayout;
use Livewire\Attributes\Computed;

class About extends AbstractPage
{
   
    use HasLayout;
 

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
