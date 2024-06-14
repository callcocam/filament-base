<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Livewire\Site;

use App\Livewire\Page\AbstractPage; 
use App\Traits\HasLayout;

class Contact extends AbstractPage
{
   
    use HasLayout;

    public $form = [
        'name' => '',
        'email' => '',
        'message' => '',
    ];
 

    public function send()
    {
        $this->validate([
            'form.name' => 'required|min:3',
            'form.email' => 'required|email',
            'form.message' => 'required|min:3',
        ]);

        $data =  $this->form; 

        // Send email
        // Mail::to(config('mail.from.address'))->send(new ContactMail($data));

        $this->reset(['form']);

        session()->flash('success', 'Your message has been sent successfully.');
    }

    public function view()
    {
        return 'livewire.site.contact';
    }
}
