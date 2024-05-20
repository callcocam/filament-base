<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Filament\Resources\Acl\UserResource\Pages;

use App\Filament\Resources\Acl\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords; 

class ListUsers extends ListRecords
{ 
    
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
