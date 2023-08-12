@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('app.incomes.index'))

@section('page::title')

<div class="flex flex-col">
    <h2>{{ $income->name }}</h2>  

    <div class="font-normal flex mt-2 text-gray-600 space-x-4 text-sm">
    
        <div class="flex items-center">
            @svg('info', 'w-4 h-4 mr-1') {{ $income->subtype->name }}
        </div>

        <div class="flex items-center">
            @svg('calendar', 'w-4 h-4 mr-1') {{ $income->frequency }}
        </div>

        <div class="flex items-center">
            @svg('banknotes', 'w-4 h-4 mr-1') TODO
        </div>

        @if($income->url)
            <a href="{{ $income->url }}" target="_blank" class="flex items-center">@svg('external-link', 'w-4 h-4 mr-1') Visit</a>
        @endif

    </div>

</div>

@endsection

@push('head::end')
    @vite(['resources/js/highcharts.js', 'resources/css/highcharts.css'])
@endpush

@section('content')

    <div class="sticky top-0">
        <x-navbar :links="[
            [
                'label' => 'Overview',
                'route' => route('app.incomes.show', $income),
                'active' => 'app.incomes.show'
            ],
            [
                'label' => 'Entitlements',
                'route' => route('app.incomes.entitlements.show', $income),
                'active' => 'app.incomes.entitlements.*'
            ],
            [
                'label' => 'Taxes',
                'route' => route('app.incomes.taxes.show', $income),
                'active' => 'app.incomes.taxes.*'
            ],
            [
                'label' => 'Deductions',
                'route' => route('app.incomes.deductions.show', $income),
                'active' => 'app.incomes.deductions.*'
            ],
            [
                'label' => 'Settings',
                'route' => route('app.incomes.edit', $income),
                'active' => 'app.incomes.edit'
            ],
        ]" />
    </div>

    <div>
        @yield('tab')
    </div>

@endsection