@props([
    'as' => 'button',
    'type' => 'button',
    'text' => 'Button',
])

<{{ $as }} @if($type="button")type="{{ $type }}"@endif {{ $attributes->twMerge('px-5 font-semibold inline-block py-2.5 bg-gray-50 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 select-none') }}>
    {{ $slot ?? $text }}
</{{ $as }}>