<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Livewire\Attributes\Computed;
use App\Livewire\Page\Navigation\Navigation;
use Illuminate\Support\Facades\Cache;

new class extends Component {
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>
<div class="hidden md:flex items-center">
    <div>
        <a href="/"
            class="text-sm font-bold text-slate-900 dark:text-slate-100 leading-none flex items-center mx-4">
            @if (config('app.tenant.featured_image'))
                <img src="{{ asset(config('app.tenant.featured_image.url')) }}" alt="{{ config('app.name') }}" class="h-8 w-auto" />
            @endif
            <div class="hidden">
                <span> {{ config('app.name') }}</span>
                <p class="text-xs text-gray-500 dark:text-gray-300">
                    {{ config('app.tenant.email') }}
                </p>
            </div>
        </a>
    </div>
    <div class="flex items-center space-x-4">
        @if ($menus = data_get($menus, 'items', []))  
            @foreach ($menus as $menu)
                @if ($childrens = data_get($menu, 'children', []))
                    <x-menu.link.dropdown x-data="dropdown()">
                        <x-slot name="trigger">
                            <x-menu.link.button type="button">
                                <span>
                                    {{ data_get($menu, 'label') }}
                                </span>
                                <x-heroicon-o-chevron-down
                                    class="w-4 h-4 ml-auto duration-200 transform group-hover:-rotate-180" />
                            </x-menu.link.button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="flex flex-col">
                                @foreach (array_chunk($childrens, data_get($menu, 'chunk', 100)) as $items)
                                    @if (!$loop->first)
                                        <div
                                            class="border-t-2 border-t-slate-100 dark:border-t-slate-700 shadow-lg mb-2">
                                        </div>
                                    @endif
                                    @foreach ($items as $item)
                                        @if ($link = data_get($item, 'data.url'))
                                            <x-menu.link.sub-desktop :href="$link"
                                                target="{{ data_get($item, 'data.target') }}">
                                                {{ data_get($menu, 'label') }}
                                            </x-menu.link.sub-desktop>
                                        @else
                                            @if (Route::has(data_get($item, 'route')))
                                                <x-menu.link.sub-desktop :href="route(data_get($item, 'route'))" :active="request()->routeIs(data_get($item, 'route'))"
                                                    wire:navigate target="{{ data_get($item, 'data.target') }}">
                                                    {{ data_get($item, 'label') }}
                                                </x-menu.link.sub-desktop>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                        </x-slot>
                    </x-menu.link.dropdown>
                @else
                    @if ($link = data_get($menu, 'data.url')) 
                        <x-menu.link.desktop :href="$link" target="{{ data_get($menu, 'data.target', '_self') }}">
                            {{ data_get($menu, 'label') }}
                        </x-menu.link.desktop>
                    @else
                    <x-menu.link.desktop :href="route(data_get($menu, 'route'), ['page'=>data_get($menu, 'slug')])" :active="request()->routeIs(data_get($menu, 'route'))" wire:navigate
                        target="{{ data_get($menu, 'data.target', '_self') }}">
                        {{ data_get($menu, 'label') }}
                    </x-menu.link.desktop>
                    @endif
                @endif
            @endforeach
        @endif
    </div>
</div>
