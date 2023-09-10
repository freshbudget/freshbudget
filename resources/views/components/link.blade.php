@props([
    'spa' => true,
    'hover' => true
])

<a 
    x-data="{}"
    @if($spa) 
        @if($hover)
            wire:navigate.hover
        @else
            wire:navigate 
        @endif
    @endif {{ $attributes }}>
    {{ $slot }}
</a>