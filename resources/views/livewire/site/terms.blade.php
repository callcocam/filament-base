<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
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
    <div class="flex flex-col px-4 py-12">
        @if($this->terms->count() > 0)
            @foreach($this->terms as $term)
                <div class="flex flex-col items-center justify-center space-y-4">
                    <h1 class="text-4xl text-gray-800 dark:text-white font-bold">{{ $term->title }}</h1>
                    <p class="text-gray-600 dark:text-gray-50 text-center">
                        {{ $term->description }}
                    </p>
                </div>
            @endforeach
        @else
            <div class="flex flex-col items-center justify-center space-y-4">
                <h1 class="text-4xl text-gray-800 dark:text-white font-bold">{{ __('TERMS_TITLE_PAGE') }}</h1>
                <p class="text-gray-600 dark:text-gray-50 text-center">
                    {{ __('No terms content available') }}
                </p>
            </div>
        @endif 
    </div>
</div>
