@props(['for'])
@error($for)<span {{ $attributes->merge(['class' => 'text-sm text-red-400 select-none inline-block']) }}>{{ $message }}</span>@enderror