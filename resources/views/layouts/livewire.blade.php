@extends('layouts.base')

@push('head::end')
    <style>[x-cloak] { display: none !important; }</style>
    @livewireStyles
    @vite(['resources/css/app.css'])
@endpush

@push('body::end')
    @livewire('spotlight-pro')    
    @livewireScripts
    @vite(['resources/js/app.js'])
@endpush