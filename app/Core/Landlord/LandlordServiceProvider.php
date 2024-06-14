<?php
/**
* Created by Claudio Campos.
* User: callcocam@gmail.com, contato@sigasmart.com.br
* https://www.sigasmart.com.br
*/
namespace App\Core\Landlord;

use App\Core\Facades\Tenant;
use App\Models\Tenant as ModelsTenant;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class LandlordServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootTenant();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(TenantManager::class, function () {
            return new TenantManager();
        });
    }

    public function bootTenant()
    {

        if(app()->runningInConsole()){
            return false;
        }
        $tenant = null;
        try {
            $tenant = app($this->getModel())->query()->where('domain', str_replace("admin.", "", request()->getHost()))->first();
            if (!$tenant) :
                die(response("Nenhuma empresa cadastrada com esse endereço " . str_replace("admin.", "", request()->getHost()), 401));
            endif;
            if ($tenant) {
                app(TenantManager::class)->addTenant("tenant_id", data_get($tenant, 'id')); 
                config([
                    'app.tenant_id' => $tenant->id,
                    'app.name' => Str::limit($tenant->name, 20, '...'),
                    'app.tenant' => $tenant->toArray(),
                ]);
            }
        } catch (\PDOException $th) {

            throw $th;
        }
    }
    
    public  function getModel(): string
    {
        return config('tenant.models.tenant', ModelsTenant::class);
    }
}
