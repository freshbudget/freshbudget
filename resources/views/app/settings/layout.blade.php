@extends('layouts.app')

@section('page::title', 'Account Settings')

@section('content')

    <x-navbar :links="[
        [
            'label' => 'General',
            'route' => route('app.settings.personal'),
            'active' => 'app.settings.personal'
        ],
        [
            'label' => 'Security',
            'route' => route('app.settings.security'),
            'active' => 'app.settings.security'
        ],
        [
            'label' => 'Notifications',
            'route' => '#',
            'active' => 'app.settings.notifications'
        ],
    ]" />

    <div class="max-w-3xl mx-auto px-4 my-10">

        @yield('tab')
    
    </div>

@endsection