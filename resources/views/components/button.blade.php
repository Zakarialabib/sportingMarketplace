@props([
    'type' => null,
    'href' => '#',
    'primary' => false,
    'secondary' => false,
    'info' => false,
    'alert' => false,
    'success' => false,
    'danger' => false,
    'warning' => false,
    'black' => false,
    'primaryOutline' => false,
    'secondaryOutline' => false,
    'infoOutline' => false,
    'successOutline' => false,
    'alertOutline' => false,
    'dangerOutline' => false,
    'warningOutline' => false,
    'blackOutline' => false,
])

@php
    $classes =
        ($primary ? 'bg-redBrick-600 border border-transparent text-white hover:bg-redBrick-600 focus:ring-redBrick-500 active:bg-redBrick-900 focus:outline-none focus:border-redBrick-900' : '') .
        ($secondary ? 'bg-gray-500 border border-transparent text-white hover:bg-gray-600 focus:ring-gray-500 active:bg-gray-900 focus:outline-none focus:border-gray-900' : '') .
        ($info ? 'bg-blue-500 border border-transparent text-white hover:bg-blue-600 focus:ring-blue-500 active:bg-blue-900 focus:outline-none focus:border-blue-900' : '') .
        ($alert ? 'bg-yellow-500 border border-transparent text-white hover:bg-yellow-600 focus:ring-yellow-500 active:bg-yellow-900 focus:outline-none focus:border-yellow-900' : '') .
        ($success ? 'bg-green-500 border border-transparent text-white hover:bg-green-600 focus:ring-green-500 active:bg-green-900 focus:outline-none focus:border-green-900' : '') .
        ($danger ? 'bg-red-500 border border-transparent text-white hover:bg-red-600 focus:ring-red-500 active:bg-red-900 focus:outline-none focus:border-red-900' : '') .
        ($warning ? 'bg-yellow-500 border border-transparent text-white hover:bg-yellow-600 focus:ring-yellow-500 active:bg-yellow-900 focus:outline-none focus:border-yellow-900' : '') .
        ($primaryOutline ? 'bg-transparent border border-redBrick-500 text-redBrick-500 hover:bg-redBrick-500 hover:text-white active:bg-redBrick-900 focus:outline-none focus:border-redBrick-900 focus:ring ring-redBrick-300' : '') .
        ($secondaryOutline ? 'bg-transparent border border-gray-500 text-gray-500 hover:bg-gray-500 hover:text-white active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300' : '') .
        ($infoOutline ? 'bg-transparent border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300' : '') .
        ($successOutline ? 'bg-transparent border border-green-500 text-green-500 hover:bg-green-500 hover:text-white active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring ring-green-300' : '') .
        ($alertOutline ? 'bg-transparent border border-yellow-500 text-yellow-500 hover:bg-yellow-500 hover:text-white active:bg-yellow-900 focus:outline-none focus:border-yellow-900 focus:ring ring-yellow-300' : '') .
        ($dangerOutline ? 'bg-transparent border border-red-500 text-red-500 hover:bg-red-500 hover:text-white active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300' : '') .
        ($warningOutline ? 'bg-transparent border border-orange-500 text-orange-500 hover:bg-orange-500 hover:text-white active:bg-orange-900 focus:outline-none focus:border-orange-900 focus:ring ring-orange-300' : '') .
        ($blackOutline ? 'bg-transparent border border-gray-800 text-black hover:bg-gray-900 hover:text-white active:bg-gray-900 focus:outline-none focus:border-black focus:ring ring-orange-300' : '');
@endphp

@if ($type == 'submit' || $type == 'button')
    <button
        {{ $attributes->merge(['type' => $type, 'class' => 'inline-flex items-center px-4 py-2 font-semibold text-xs uppercase tracking-widest disabled:opacity-25 transition ease-in-out duration-150 ' . $classes]) }}>
        {{ $slot }}
    </button>
@else
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 font-semibold text-xs uppercase tracking-widest disabled:opacity-25 transition ease-in-out duration-150 ' . $classes]) }}>
        {{ $slot }}
    </a>
@endif
