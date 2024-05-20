<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Filament\Resources\Acl\GroupResource\Pages;

use App\Filament\Resources\Acl\GroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord; 

class EditGroup extends EditRecord
{ 
    
    protected static string $resource = GroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
