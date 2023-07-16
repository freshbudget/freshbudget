@extends('layouts.app')

@section('page::title', $budget->name)
@section('breadcrumbs', Breadcrumbs::render('app.budgets.index'))

@section('content')

    <div class="sticky top-0 w-full bg-white border-b border-gray-300 select-none">

        <nav class="flex w-full px-4 -mb-px space-x-3">

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

            @foreach ($links as $link)
                
                <a href="{{ $link['route'] }}" class="block px-1 text-sm py-3 border-b-2 {{ active($link['active'], 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                    {{ $link['label'] }}
                </a>

            @endforeach

        </nav>

    </div>

    <div class="max-w-3xl mx-auto">        
        @yield('tab')
    </div>

@endsection