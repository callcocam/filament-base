@props(['items', 'subtitle' => null])
@if ($subtitle)
    <x-menu.link.subtitle>
        <x-slot name="trigger">
            <span>
                {{ $subtitle }}
            </span>
        </x-slot>
        <x-slot name="content">
            @foreach ($items as $item)
                @if ($link = data_get($item, 'data.url'))
                    <x-menu.link.sub-desktop :href="$link" target="{{ data_get($item, 'data.target') }}">
                        {{ data_get($item, 'label') }}
                    </x-menu.link.sub-desktop>
                @else
                    @if (Route::has(data_get($item, 'route')))
                        <x-menu.link.sub-desktop :href="route(data_get($item, 'route'))" :active="request()->routeIs(data_get($item, 'route'))" wire:navigate
                            target="{{ data_get($item, 'data.target') }}">
                            {{ data_get($item, 'label') }}
                        </x-menu.link.sub-desktop>
                    @endif
                @endif
            @endforeach
        </x-slot>
    </x-menu.link.subtitle>
@else
    @if ($link = data_get($items, 'data.url'))
        <x-menu.link.sub-desktop :href="$link" target="{{ data_get($items, 'data.target') }}">
            {{ data_get($items, 'label') }}
        </x-menu.link.sub-desktop>
    @else
        @if (Route::has(data_get($items, 'route')))
            <x-menu.link.sub-desktop :href="route(data_get($items, 'route'))" :active="request()->routeIs(data_get($items, 'route'))" wire:navigate
                target="{{ data_get($items, 'data.target') }}">
                {{ data_get($items, 'label') }}
            </x-menu.link.sub-desktop>
        @endif
    @endif
@endif
