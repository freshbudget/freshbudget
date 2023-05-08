@extends('layouts.base')

@push('head::end')
    @livewireStyles
    @vite(['resources/css/app.css'])
@endpush

@push('body::end')
    @livewireScripts
    @vite(['resources/js/app.js'])
@endpush

@section('body')
    @yield('page')
@endsection