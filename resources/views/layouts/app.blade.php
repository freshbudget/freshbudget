@extends('layouts.livewire')

@section('page')

    <h1>App Layout</h1>

    <p>Your logged in as {{ auth()->user()->name }} ({{ auth()->user()->email }})</p>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>

    @yield('content')

@endsection