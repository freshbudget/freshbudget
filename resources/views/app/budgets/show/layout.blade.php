@extends('layouts.app')

@section('content')

    <div class="sticky top-0">

        @php
            $links = [
                [
                    'label' => 'General',
                    'route' => route('app.budgets.show', $budget),
                    'active' => 'app.budgets.show'
                ],
                [
                    'label' => 'Members',
                    'route' => route('app.budgets.members.index', $budget),
                    'active' => 'app.budgets.members.index'
                ],
                [
                    'label' => 'Settings',
                    'route' => route('app.budgets.edit', $budget),
                    'active' => 'app.budgets.edit'
                ]
            ]
        @endphp

        <x-navbar :links="$links" />

    </div>

    <div class="max-w-3xl mx-auto">        
        @yield('tab')
    </div>

@endsection