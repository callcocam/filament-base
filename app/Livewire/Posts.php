<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire;

use App\Models\Page;
use Livewire\Component;

class Posts extends Component
{

    public $data = [];

    public $page;

    public function mount(Page $page)
    {
        $this->page = $page->toArray();
    } 

    public function render()
    {
        return view($this->view(),  $this->data);
    }


    public function view()
    {
        return 'livewire.posts';
    }
}
