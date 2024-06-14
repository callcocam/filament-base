<?php

namespace App\Providers;

use App\Core\Filament\Plugins\Navigation\Builder\Models\Navigation;
use App\Policies\ActivityPolicy;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Activity::class, ActivityPolicy::class);
        $this->app->singleton(Navigation::class, function () {
            return new Navigation();
        });

        view()->composer('*', function ($view) {
            $view->with('menus', $this->menus());
        });
    }

    public function menus()
    {
        return Cache::remember(sprintf("menus-model-%s", config('app.tenant_id')), 60 * 60 * 24, function () {
            return Navigation::query()
                ->where('tenant_id', config('app.tenant_id'))
                ->first();
        });
    }
}
