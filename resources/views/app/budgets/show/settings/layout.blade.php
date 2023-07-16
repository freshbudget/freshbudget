@extends('layouts.app')

@section('page::title', 'Settings')
@section('breadcrumbs', Breadcrumbs::render('app.budgets.show', $budget))

@section('content')

    <div class="sticky top-0 w-full bg-white border-b border-gray-300 select-none">

        <nav class="flex w-full px-4 -mb-px space-x-3">

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

            @foreach ($links as $link)
                
                <a href="{{ $link['route'] }}" class="block px-1 text-sm py-3 border-b-2 {{ active($link['active'], 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                    {{ $link['label'] }}
                </a>

            @endforeach

        </nav>

    </div>

    <div class="max-w-3xl mx-auto px-4">        
        @yield('tab')
    </div>

@endsection