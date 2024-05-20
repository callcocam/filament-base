<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Filament\Resources\Acl\PermissionResource\Pages;

use App\Filament\Resources\Acl\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord; 

class EditPermission extends EditRecord
{ 
    
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
