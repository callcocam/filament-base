<?php

namespace App\Core\Filament\Plugins\Navigation\Builder\Filament\Resources\NavigationResource\Pages;

use App\Core\Filament\Plugins\Navigation\Builder\BuilderNavigation;
use Filament\Resources\Pages\CreateRecord;
use App\Core\Filament\Plugins\Navigation\Builder\Filament\Resources\NavigationResource\Pages\Concerns\HandlesNavigationBuilder;
use App\Core\Filament\Plugins\Navigation\Builder\Filament\Resources\NavigationResource\Pages\Concerns\HasStyles;
use App\Core\Filament\Plugins\Navigation\Builder\FilamentNavigation;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use App\Livewire\Page\Navigation\Navigation as NavigationNavigation;
use Illuminate\Support\Facades\Cache;

class CreateNavigation extends CreateRecord
{
    use HandlesNavigationBuilder;
    use HasStyles;

    public static function getResource(): string
    {
        return FilamentNavigation::get()->getResource();
    }


    // public function mount(): void
    // {
    //     //  dd($this->getNavigationOptions());
    // }

    public function getItem($item, $name, $childrens = [])
    {
        return [
            'name' => $name,
            'label' => $item->getLabel(),
            'parent' => $item->getParentItem(),
            'slug' => $item->getSlug(),
            'icon' => $item->getIcon(),
            'route' => $item->getRouteIndexName(),
            'params' => $item->getNavigationParams(),
            'data' => [
                'url' => $item->getNavigationLink(),
                'target' => $item->getNavigationTarget(),
            ],
            'type' => $item->getNavigationType(),
            'order' => $item->getSort(),
            'chunk' => $item->getChunk(),
            'children' => $childrens
        ];
    }

    public function getNavigationOptions(): array
    {
        $navigations = [];

        if ($originalNavigations = Cache::remember(sprintf("menus-%s", config('app.tenant_id')), 60 * 60 * 24, function () {
            return BuilderNavigation::make()->loadPages()->navigationGroups()->getNavigations();
        })) {
            foreach ($originalNavigations as $navigation) {

                if ($navigation->hasNavigationGroupItem()) {
                    $item =  $navigation->getNavigationGroupItem();
                    $uuid = Str::uuid()->toString();
                    $navigations[$uuid] =  $this->getItem($item, $item->getPageId());
                } else {
                    if ($navigation->hasNavigationGroupItems()) {
                        $childrens = [];
                        foreach ($navigation->getNavigationGroupItems() as $navigationGroupItems) {
                            foreach ($navigationGroupItems as $navigationGroupItem) {
                                $uuid = Str::uuid()->toString();
                                $childrens[$uuid] = $this->getItem($navigationGroupItem, $navigationGroupItem->getPageId());
                            }
                        }
                        $uuid = Str::uuid()->toString();
                        $navigations[$uuid] =  [
                            'name' => $navigation->getNavigationGroupId(),
                            'label' => $navigation->getNavigationGroupLabel(),
                            'parent' => $navigation->getNavigationGroupId(),
                            'slug' => $navigation->getNavigationGroupId(),
                            'icon' => $navigation->getNavigationGroupIcon(),
                            'route' => null,
                            'params' => null,
                            'chunk' => $navigation->getNavigationGroupChunk(),
                            'order' => $navigation->getNavigationGroupOrder(),
                            'children' => $childrens
                        ];
                    }
                }
            }
        }
        return $navigations;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Hidden::make('items')
                    ->default($this->getNavigationOptions()),
                Forms\Components\Hidden::make('name'),
                Forms\Components\Hidden::make('handle'),
                Forms\Components\Select::make('tenant_id')
                    ->label(__('filament-navigation::filament-navigation.attributes.tenant_id'))
                    ->options(function () {
                        return \App\Models\Tenant::all()->pluck('name', 'id');
                    })->reactive()
                    ->debounce()
                    ->unique()
                    ->afterStateUpdated(function (?string $state, Set $set) {
                        if (!$state) {
                            return;
                        }
                        $name = Tenant::find($state)->name;
                        $set('name', $name);
                        $set('handle', Str::slug($name));
                    })
                    ->required(),
            ])
            ->columns(1);
    }
}
