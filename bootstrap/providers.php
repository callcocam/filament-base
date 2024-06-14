<?php

return [
    App\Core\Acl\AclServiceProvider::class,
    App\Core\Filament\Plugins\Navigation\Builder\FilamentNavigationServiceProvider::class,
    App\Core\Landlord\LandlordServiceProvider::class,
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\FolioServiceProvider::class,
    App\Providers\VoltServiceProvider::class,
];
