<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Filament\Resources\Acl\GroupResource\Pages;

use App\Filament\Resources\Acl\GroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords; 

class ListGroups extends ListRecords
{ 
    
    protected static string $resource = GroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
