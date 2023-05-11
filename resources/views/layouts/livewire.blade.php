@extends('layouts.base')

@push('head::end')
    <style>[x-cloak] { display: none !important; }</style>
    @livewireStyles
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
    {{-- @vite(['resources/css/app.css']) --}}
@endpush

@push('body::end')
    @livewireScripts
    @vite(['resources/js/app.js'])
@endpush

@section('body')
    @yield('page')
@endsection