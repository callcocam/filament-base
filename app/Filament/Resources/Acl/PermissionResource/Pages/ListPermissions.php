<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Filament\Resources\Acl\PermissionResource\Pages;

use App\Core\Helpers\LoadRouterHelper;
use App\Filament\Resources\Acl\PermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermissions extends ListRecords
{

    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make("Sincronizar Permissões")
                ->icon('heroicon-o-arrow-path')
                ->requiresConfirmation()
                ->color('danger')
                ->action(fn () => LoadRouterHelper::make()->save())
        ];
    }
}
