<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Filament\Resources\Acl\PermissionResource\Pages;


use App\Filament\Resources\Acl\PermissionResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;
use Illuminate\Support\Str;

class ListActivitiesPermission extends ListActivities
{
    protected static string $resource = PermissionResource::class;

     /**
     * @param  array<string, mixed>  $parameters
     */
    public static function canAccess(array $parameters = []): bool
    {
        $permissionFormated = Str::of(static::getRouteName())->lower()
            ->replace("pages.", "")
            ->replace("resources.", "")
            ->replace("admin", config('acl.route.prefix', 'admin'))
            ->replace('filament.', '')->__toString(); 
        return auth()->user()->can($permissionFormated);
    }
}
