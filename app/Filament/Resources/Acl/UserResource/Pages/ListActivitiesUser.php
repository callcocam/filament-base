<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Filament\Resources\Acl\UserResource\Pages;


use App\Filament\Resources\Acl\UserResource;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ListActivitiesUser extends ListActivities
{
    protected static string $resource = UserResource::class;
}
