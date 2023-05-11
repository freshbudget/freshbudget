@extends('layouts.base')

@push('body::start')
    @vite(['resources/css/marketing.css', 'resources/js/marketing.js'])    
@endpush

@section('body')

    <h1>Marketing layout</h1>

    <ul>
        <li><a href="{{ route('login') }}">Login</a></li>
        <li><a href="{{ route('register') }}">Sign up</a></li>
    </ul>
    
    @yield('page')

@endsection