<div class="hidden md:flex items-center">
    <div>
        <a href="/"
            class="text-sm font-bold text-slate-900 dark:text-slate-100 leading-none flex items-center mx-4">
            @if (config('app.tenant.logo'))
                <img src="{{ asset(config('app.tenant.logo')) }}" alt="{{ config('app.name') }}" class="h-8 w-auto" />
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
        @if ($menus)
            @foreach ($menus as $menu)
                @if ($menu->getNavigationGroupItems())
                    <x-menu.link.dropdown x-data="dropdown()" >
                        <x-slot name="trigger">
                            <x-menu.link.button type="button">
                                <span>
                                    {{ $menu->getNavigationGroupLabel() }}
                                </span>
                                <x-heroicon-o-chevron-down class="w-4 h-4 ml-auto duration-200 transform group-hover:-rotate-180" />
                            </x-menu.link.button>
                        </x-slot>
                        <x-slot name="content">
                            <div class="flex flex-col">
                                @foreach ($menu->getNavigationGroupItems() as $items)
                                    @if (!$loop->first)
                                        <div
                                            class="border-t-2 border-t-slate-100 dark:border-t-slate-700 shadow-lg mb-2">
                                        </div>
                                    @endif
                                    @foreach ($items as $item)
                                        <x-menu.link.sub-desktop :href="$item->route()" :active="request()->routeIs($item->getRouteIndex())" wire:navigate>
                                            {{ $item->getLabel() }}
                                        </x-menu.link.sub-desktop>
                                    @endforeach
                                @endforeach
                            </div>
                        </x-slot>
                    </x-menu.link.dropdown>
                @else
                    @if ($item = $menu->getNavigationGroupItem())
                        <x-menu.link.desktop :href="$item->route()" :active="request()->routeIs($item->getRouteIndex())" wire:navigate>
                            {{ $item->getLabel() }}
                        </x-menu.link.desktop>
                    @endif
                @endif
            @endforeach
        @endif
    </div>
</div>
