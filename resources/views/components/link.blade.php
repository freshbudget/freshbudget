@props([
    'spa' => true
])

<a @if($spa) wire:navigate @endif {{ $attributes }}>{{ $slot }}</a>