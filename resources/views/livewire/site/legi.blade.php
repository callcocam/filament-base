<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
     <x-slot name="header">
        <x-breadcrumbs :sub_title="$sub_title" :title="$title">
            <li>
                <span
                    class=" text-primary-100 px-2 py-2 rounded-md text-sm flex space-x-2 items-center justify-center">
                    <x-heroicon-o-chevron-right class="h-4 w-4" />
                    <span> {{ __($sub_title) }}</span>
                </span>
            </li>
        </x-breadcrumbs>
    </x-slot>
</div>
