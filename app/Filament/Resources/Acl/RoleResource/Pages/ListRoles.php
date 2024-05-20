<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Filament\Resources\Acl\RoleResource\Pages;

use App\Filament\Resources\Acl\RoleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords; 

class ListRoles extends ListRecords
{ 
    
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
