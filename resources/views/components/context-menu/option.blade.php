@props([
    'as' => 'a',
])

<{{ $as }} tabindex="0" x-on:click="contextMenuOpen=false" {{ $attributes->twMerge('relative flex cursor-default select-none group items-center rounded px-2 py-1.5 hover:bg-gray-100 outline-none pl-6 data-[disabled]:opacity-50 data-[disabled]:pointer-events-none') }} {{ $attributes }}>
    <span>{{ $slot }}</span>
</{{ $as }}>