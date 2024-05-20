<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Filament\Resources\TenantResource\Pages;


use App\Filament\Resources\TenantResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListActivitiesTenant extends ListActivities
{
    protected static string $resource = TenantResource::class;
}
