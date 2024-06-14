@props(['align' => 'right', 'width' => 'full', 'contentClasses' => 'bg-white dark:bg-gray-700'])

@php
    switch ($align) {
        case 'left':
            $alignmentClasses = 'ltr:origin-top-left rtl:origin-top-right start-0';
            break;
        case 'top':
            $alignmentClasses = 'origin-top';
            break;
        case 'right':
        default:
            $alignmentClasses = 'ltr:origin-top-right rtl:origin-top-left end-0';
            break;
    }

    switch ($width) {
        case '48':
            $w = 'w-48';
            break;
        case '64':
            $w = 'w-64';
            break;
        case '96':
            $w = 'w-96';
            break;
        case 'full':
            $w = 'w-full min-w-[560px]';
            break;
    }
@endphp

<div class="group relative flex items-center">
    {{ $trigger }}
    <div
        class=" invisible absolute -left-32  top-6 z-50  {{ $w }}  translate-y-0 transform opacity-0 transition duration-500 ease-in-out group-hover:visible group-hover:translate-y-5 group-hover:transform group-hover:opacity-100">
        <div class="relative top-6 w-full rounded-xl {{ $contentClasses }}  p-3 shadow-xl">
            <x-menu.arrow-top contentClasses="{{ $contentClasses }}" :whith="$width" />
            <div class="rounded-md w-full ">
                {{ $content }}
            </div>
        </div>
    </div>
</div> 
