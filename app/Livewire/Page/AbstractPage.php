<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Livewire\Page;
 
use Illuminate\Support\Facades\Route;
use Livewire\Component;

abstract class AbstractPage extends Component
{
    use Concerns\SeoTrait;
    use Concerns\CanTrait;

    protected $navigations = [];

    protected static  string|int|null $navigationOrder = -1;

    protected static ?int $navigationGroupOrder = 0;


    public function mount()
    {
        $sub_title = class_basename(static::class);
        $sub_title = str($sub_title)->upper()->__toString();
        $sub_title = sprintf('%s_TITLE_BREADCRUMP_PAGE', $sub_title);
        $this->layoutData(['title' => 'Dashboard', 'sub_title' => $sub_title]);
    }

    public static function route()
    {
        Route::get(static::getSlug(), static::class)->name(sprintf("%s.index", static::getNavigationRoute()));
    }

    protected static function getBasePath(): mixed
    {
        return str(static::class)->lower()
            ->afterLast('livewire')->replace('\\', '/');
    }

    public static function getSlug(): string
    {
        return __(sprintf('%s.slug', static::getlangPath()));
    }

    public static function getlangPath(): string
    {
        $resource = static::getBasePath()->__toString();

        //Montar o caminho do arquivo de tradução baseado no tenant
        $pathTenant = str($resource)->lower()->replace('site/', sprintf('pages/site/%s/', config('app.tenant_id')))->__toString();
        $locale = str($resource)->lower()->replace('site/', sprintf('pages/site/%s/', config('app.tenant_id')))->beforeLast('/');
        $locale = lang_path(sprintf("%s/%s", app()->getLocale(), $locale));
        $locale = str($locale)->replace('//', '/')->__toString();
        $name = class_basename(static::class);
        $name = str($name)->lower()->__toString();
        $name = sprintf('%s.php', $name);
        if (file_exists(sprintf('%s/%s', $locale, $name))) {
            return $pathTenant;
        }
        $path = sprintf('pages%s', $resource);

        return   $path;
    }

    public static function getNavigationLabel(): string
    {

        $resource = static::getlangPath();

        $path = sprintf('%s.navigationLabel', $resource);

        return   __($path);
    }




    public static function getNavigationIcon(): string|null
    {

        return null;
    }

    public static function getRouteIndex(): string
    {
        return route(sprintf("%s.index", static::getNavigationRoute()));
    }

    public static function getRouteIndexName(): string
    {
        return sprintf("%s.index", static::getNavigationRoute());
    }

    public static function getRouteView(): string
    {
        return route(sprintf("%s.view", static::getNavigationRoute()));
    }

    public static function getRouteViewName(): string
    {
        return sprintf("%s.view", static::getNavigationRoute());
    }

    public static function getNavigationRoute(): string
    {

        $resource = static::getBasePath()->replace('/', '.')->__toString();

        $path = sprintf('pages%s', $resource);

        return  $path;
    }

    public static function getNavigationParams(): mixed
    {
        return   [];
    }

    public static function getNavigationTarget(): string|null
    {
        return null;
    }

    public static function getNavigationParent(): string|null
    {
        $resource = static::getBasePath()->__toString();
        $resource = str($resource)->afterLast('site')->__toString();
        $pathArray = explode('/', $resource);
        $pathArray = array_filter($pathArray);
        if (count($pathArray) == 1)
            return null;
        //pager o primeiro item do array 
        $path = array_shift($pathArray);

        return $path;
    }

    public static function getNavigationOrder(): string|null
    {
        return static::$navigationOrder;
    }

    public static function getNavigationActive(): string|null
    {
        return  request()->routeIs(sprintf("%s.*", static::getNavigationRoute())) ? 'active' : '';
    }

    public static function getNavigationBadge(): string|null
    {
        return null;
    }

    public static function getViewMenu(): string|null
    {
        return  null;
    }

    public static function getNavigationGroupIcon(): string|null
    {
        return   null;
    }

    public static function getNavigationGroupLabel(): string
    {

        $resource = static::getBasePath()->__toString();

        $path = sprintf('pages%s.navigationGroupLabel', $resource);
 
        return   __($path);
    }

    public static function getNavigationGroupId(): string
    {
        return static::getSlug();
    }

    public static function getNavigationGroupOrder(): int
    {
        return static::$navigationGroupOrder;
    }

    public static function getNavigationGroupChunk(): int
    {
        return  10;
    }

    public static function getNavigationLink(): string|null
    {
        return null;
    }

    public static function getVisible(): bool
    {
        return true;
    }

    public static function getPageId(): string
    {
        return str(static::class)->lower()
            ->afterLast('livewire')->after('site\\')->replace('\\', '-')->__toString();
    }
}
