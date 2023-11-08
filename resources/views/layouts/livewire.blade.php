@extends('layouts.base')

@push('head::end')
    <style>[x-cloak] { display: none !important; }</style>
    @vite(['resources/css/app.css'])
@endpush

@push('body::end')
    @livewireScriptConfig
    @vite(['resources/js/app.js'])
@endpush