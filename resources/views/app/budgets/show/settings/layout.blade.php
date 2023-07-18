@extends('layouts.app')

@section('page::title', 'Settings')
@section('breadcrumbs', Breadcrumbs::render('app.budgets.show', $budget))

@section('content')

    <div class="sticky top-0">
        <x-navbar :links="[
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
        ]" />
    </div>

    <div class="max-w-3xl mx-auto px-4">        
        @yield('tab')
    </div>

@endsection