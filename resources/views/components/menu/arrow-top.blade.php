@props(['contentClasses' => 'bg-gray-800', 'width' => '64'])
@php
    switch ($width) {
        case '48':
            $w = 'group-hover:translate-x-[12rem]';
            break;
        case '64':
            $w = 'group-hover:translate-x-[9rem]';
            break;
        case '96':
            $w = 'group-hover:translate-x-[4rem]';
            break;
        case 'full':
            $w = 'group-hover:translate-x-[12rem]';
            break;
    }
@endphp
<div
    class="absolute -top-2 z-0 h-7 w-7 translate-x-0 rotate-45 transform rounded {{ $contentClasses }}  transition-transform duration-500 ease-in-out {{ $w }}">
</div>
