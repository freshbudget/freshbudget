@extends('layouts.base')

@push('body::start')
    @vite(['resources/css/marketing.css', 'resources/js/marketing.js'])    
@endpush

@section('body')
    
    @yield('page')

@endsection