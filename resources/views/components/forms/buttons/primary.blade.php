@props([
    'as' => 'button',
    'type' => 'button',
    'text' => 'Button',
])

<{{ $as }} @if($as=="button")type="{{ $type }}"@endif {{ $attributes->twMerge('px-5 font-semibold inline-block py-2.5 bg-green-600 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 border border-green-700 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-green-700 focus:outline-none focus:shadow text-white shadow-sm hover:shadow-md hover:text-green-50 active:shadow-inner text-center select-none disabled:bg-opacity-70 disabled:cursor-wait') }}>
    {{ $slot }}
</{{ $as }}>