@props([
    'spa' => true
])

<a 
    @if($spa) 
        wire:navigate 
        x-data
        x-on:keydown.enter.prevent="$wire.navigate('{{ $attributes->get('href') }}')"
    @endif {{ $attributes }}>
    {{ $slot }}
</a>