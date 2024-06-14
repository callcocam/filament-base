<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Site;

use App\Livewire\Page\AbstractPage;
use App\Models\Policy as ModelsPolicy; 
use App\Traits\HasLayout;
use Livewire\Attributes\Computed;

class Policy extends AbstractPage
{
   
    use HasLayout;

    public function mount()
    {
        $this->layoutData(['title' => 'Dashboard', 'sub_title' => 'POLICY_TITLE_BREADCRUMP_PAGE']);
    }
 
    #[Computed()]
    public function policies()
    {
        return ModelsPolicy::query()->get();
    }


    public function view()
    {
        return 'livewire.site.policy';
    }
}
