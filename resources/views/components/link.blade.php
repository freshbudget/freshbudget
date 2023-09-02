@props([
    'spa' => true,
    'hover' => true
])

<a 
    @if($spa) 
        @if($hover)
            wire:navigate.hover
        @else
            wire:navigate 
        @endif
        x-data
    @endif {{ $attributes }}>
    {{ $slot }}
</a>