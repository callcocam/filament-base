<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace  App\Core\Helpers;

use App\Models\Acl\Group;
use App\Models\Acl\Permission;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;

class LoadRouterHelper
{

    /**
     * @var array
     */
    private $ignore = ['auth', 'store', 'remove-file', 'auto-route', 'translate', 'profile', 'horizon'];

    /**
     * @var array
     */
    private $required = ['admin', 'app', 'index', 'edit', 'list', 'show', 'create', 'destroy', 'delete'];


    public static function make()
    {

        $make = new static();

        return $make;
    }


    public  function save($delete = true)
    {
        if ($delete) {
            app(config('acl.models.permission', Permission::class))->query()->get()->map(function ($item) {
                $item->roles()->detach();
                $item->forceDelete();
            });
        }

        foreach (Route::getRoutes() as $route) {

            if (isset($route->action['as'])) :
                $permission = $route->action['as'];
                $data = explode(".", $permission);

                if ($this->getIgnore($data)) :

                    if ($this->getRequired($data)) :

                        $permissionFormated = Str::of($permission)->lower()
                            ->replace("pages.", "")
                            ->replace("resources.", "")
                            ->replace("admin", config('acl.route.prefix', 'admin'))
                            ->replace('filament.', '')->__toString();
                        if (app(config('acl.models.permission', Permission::class))->query()->where('slug', $permissionFormated)->count()) {
                            $permissionFormatedDelete = Str::of($permissionFormated)->replace("index", "delete")->__toString();
                            if (!app(config('acl.models.permission', Permission::class))->query()->where('slug', $permissionFormatedDelete)->count()) {
                                $this->create($permissionFormatedDelete, $data);
                            }
                            $permissionFormatedforceDelete = Str::of($permissionFormated)->replace("index", "forceDelete")->__toString();
                            if (!app(config('acl.models.permission', Permission::class))->query()->where('slug', $permissionFormatedforceDelete)->count()) {
                                $this->create($permissionFormatedforceDelete, $data);
                            }
                            $permissionFormatedRestore = Str::of($permissionFormated)->replace("index", "restore")->__toString();
                            if (!app(config('acl.models.permission', Permission::class))->query()->where('slug', $permissionFormatedRestore)->count()) {
                                $this->create($permissionFormatedRestore, $data);
                            }
                        } else {
                            if ($this->create($permissionFormated, $data)) {
                                $permissionFormatedDelete = Str::of($permissionFormated)->replace("index", "delete")->__toString();
                                if (!app(config('acl.models.permission', Permission::class))->query()->where('slug', $permissionFormatedDelete)->count()) {
                                    $this->create($permissionFormatedDelete, $data);
                                }
                                $permissionFormatedforceDelete = Str::of($permissionFormated)->replace("index", "forceDelete")->__toString();
                                if (!app(config('acl.models.permission', Permission::class))->query()->where('slug', $permissionFormatedforceDelete)->count()) {
                                    $this->create($permissionFormatedforceDelete, $data);
                                }
                                $permissionFormatedRestore = Str::of($permissionFormated)->replace("index", "restore")->__toString();
                                if (!app(config('acl.models.permission', Permission::class))->query()->where('slug', $permissionFormatedRestore)->count()) {
                                    $this->create($permissionFormatedRestore, $data);
                                }
                            }
                        }
                    endif;

                endif;

            endif;
        }
    }

    protected function create($permission, $data)
    {
        $description = Str::of($permission)->lower()->replace(".", " ")->__toString();
        $name = Str::of($permission)->lower()->__toString();
        $name  = Str::title(str_replace(".", " ", $name));
        $last = Arr::last($data);
        if (!in_array($last, ['edit', 'create', 'view', 'show',  'destroy', 'delete'])) {
            $last = "index";
        }
        $isView = $last == "view";
        $isIndex = $last == "index";
        if ($group = app(config('acl.models.access_group', Group::class))->query()->where('slug', $last)->first()) :
            $last = $group->id;
        else :
            $last = app(config('acl.models.access_group', Group::class))->create([
                'name' => $last,
                'slug' => $last,
                'status' => 'published',
                'description' => $last
            ])->id;
        endif;

        app(config('acl.models.permission', Permission::class))->create(
            [
                'name' => $name,
                'slug' => $permission,
                'group_id' => $last,
                'status' => 'published',
                'description' => $description
            ]
        );
        if ($isView) {
            $permission = Str::of($permission)->replace("view", "viewAny")->__toString();
            $description = Str::of($permission)->lower()->replace(".", " ")->__toString();
            $name = Str::of($permission)->lower()->__toString();
            app(config('acl.models.permission', Permission::class))->create(
                [
                    'name' => $name,
                    'slug' => $permission,
                    'group_id' => $last,
                    'status' => 'published',
                    'description' => $description
                ]
            );
        }
        return $isIndex;
    }

    public function getRoutes()
    {
        $options = [];

        foreach (Route::getRoutes() as $route) {

            if (isset($route->action['as'])) :

                $data = explode(".", $route->action['as']);

                if ($this->getIgnore($data)) :

                    if ($this->getRequired($data)) :
                        if (!in_array($route->action['as'], $options)) {
                            $permission = $route->action['as'];
                            $description = Str::of($permission)->lower()->replace(".", " ")->__toString();
                            $name = Str::of($permission)->lower()->replace('filament.', '')->__toString();
                            $name  = Str::title(str_replace(".", " ", $name));
                            $last = Arr::last($data);
                            if (!in_array($last, ['edit', 'create', 'view', 'show', 'index', 'list', 'destroy', 'delete'])) {
                                $last = "index";
                            }
                            array_push($options, [
                                'name' => $name,
                                'slug' => $route->action['as'],
                                'group' => $last,
                                'status' => 'published',
                                'description' => $description
                            ]);
                        }
                    endif;

                endif;

            endif;
        }
        return $options;
    }
    private function getIgnore($value)
    {

        $result = true;

        foreach ($this->ignore as $item) {

            if (in_array($item, $value)) {

                $result = false;
            }
        }

        return $result;
    }


    private function getRequired($value)
    {

        $result = false;

        foreach ($this->required as $item) {

            if (in_array($item, $value)) {

                $result = true;
            }
        }

        return $result;
    }


    public static function createRoutes($params = [])
    {
        $pages  = Finder::create()->files()->in(app_path('Livewire/Site'))->name('*.php');

        foreach ($pages as $page) {
            $namespace =  str($page->getPath())->afterLast('app')->before('.php')->replace('/', '\\')->__toString();
            $namespace = sprintf('App%s', $namespace);
            $name = $page->getFilenameWithoutExtension();
            $class = sprintf('%s\%s', $namespace, $name);

            if (class_exists($class)) {
                if (method_exists($class, 'route')) {
                    $class::route();
                }
            }
        }
    }
}
