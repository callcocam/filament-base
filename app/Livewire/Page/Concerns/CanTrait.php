<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/

namespace App\Livewire\Page\Concerns;

trait CanTrait
{
    public function canAccess()
    {
        if(auth()->check()){
            return auth()->user()->can(static::getRouteIndex(), $this->model);
        }

        return false;
    }
 
    public function canView()
    {
        if(auth()->check()){
            return auth()->user()->can(static::getRouteView(), $this->model);
        }

        return false;
    }

    public static function isVisible()
    {
        return true;
    }

}