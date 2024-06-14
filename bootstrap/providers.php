<?php

return [
    App\Core\Landlord\LandlordServiceProvider::class,
    App\Core\Acl\AclServiceProvider::class,
    App\Providers\AppServiceProvider::class,
    App\Providers\Filament\AdminPanelProvider::class,
    App\Providers\VoltServiceProvider::class,
    App\Core\Filament\Plugins\Navigation\Builder\FilamentNavigationServiceProvider::class,
];
