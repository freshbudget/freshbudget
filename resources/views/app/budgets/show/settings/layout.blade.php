@extends('layouts.app')

@section('page::title', 'Settings')
@section('breadcrumbs', Breadcrumbs::render('app.budgets.show', $budget))

@section('content')

    <div class="sticky top-0">

        @php
            $links = [
                [
                    'label' => 'General',
                    'route' => route('app.budgets.edit', $budget),
                    'active' => 'app.budgets.edit'
                ],
                [
                    'label' => 'Integrations',
                    'route' => '#',
                    'active' => '#'
                ],
                [
                    'label' => 'Billing',
                    'route' => '#',
                    'active' => '#'
                ]
            ]
        @endphp

        <x-navbar :links="$links" />

    </div>

    <div class="max-w-3xl mx-auto px-4">        
        @yield('tab')
    </div>

@endsection