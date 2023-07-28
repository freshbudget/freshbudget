@extends('layouts.base')

@push('head::end')
    <style>[x-cloak] { display: none !important; }</style>
    @filamentStyles
    @vite(['resources/css/app.css'])
@endpush

@push('body::end')
    {{-- @livewire('spotlight-pro')     --}}
    @filamentScripts
    @livewireScriptConfig
    @vite(['resources/js/app.js'])
@endpush