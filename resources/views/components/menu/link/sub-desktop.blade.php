@props(['active'])

@php
    $deafultClasses =
        'flex items-center px-2 py-2 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out z-2';
    $classes =
        $active ?? false
            ? 'border-indigo-400 dark:border-indigo-600  text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700'
            : 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:text-gray-600 dark:focus:text-gray-100 focus:border-gray-100 dark:focus:border-gray-600';
    $classes = $deafultClasses . ' ' . $classes;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
