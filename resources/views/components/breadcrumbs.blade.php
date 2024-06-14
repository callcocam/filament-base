 @props(['title', 'sub_title'])
<div class="h-64 w-full  flex items-center justify-center relative   ">
    <div class="blur-sm absolute top-0 right-0 bottom-0 left-0 bg-black/70 z-2"></div>
    <img src="{{ asset('img/brd-img-1.png') }}" alt="" class="z-0 absolute top-0 h-64 left-0">
    <img src="{{ asset('img/brd-img-2.png') }}" alt="" class="z-0 absolute top-0 h-64 right-0">
    <div class="flex flex-col justify-center items-center z-3">
        <p class="uppercase text-gray-100 font-bold">{{ __($title) }}</p>
        <h1 class="text-4xl text-white">
            {{ __($sub_title) }}
        </h1>
    </div>
    <ul
        class="prd-btn-2 z-4 absolute -bottom-4 flex items-center justify-center bg-gradient-primary rounded-full border border-gray-200 px-2">
        <li>
            <a href="{{ route('pages.site.dashboard.index') }}"
                class=" text-primary-100 px-2 py-2 rounded-md text-sm flex space-x-2 items-center justify-center">
                <x-heroicon-o-home class="h-4 w-4 text-purple-800" />
                <span> {{ __('Home') }}</span>
            </a>
        </li>
       {{ $slot }}

    </ul>
</div>
