@extends('layouts.app')

@section('page::title', 'Incomes')

@section('content')

    <x-navbar :links="[
        [
            'label' => 'Overview',
            'route' => route('app.incomes.index'),
            'active' => 'app.incomes.index'
        ],
        [
            'label' => 'List Incomes',
            'route' => route('app.incomes.list'),
            'active' => 'app.incomes.list'
        ],
        [
            'label' => 'Create Income',
            'route' => route('app.incomes.create'),
            'active' => 'app.incomes.create'
        ]
    ]" />

    <div class="max-w-6xl px-4 py-8 mx-auto prose">

        <ul>
            
            @foreach ($incomes as $income)
                <li>
                    <x-link href="{{ route('app.incomes.show', $income) }}">
                        {{ $income->name }}
                    </x-link>
                </li>
            @endforeach

        </ul>
        
    </div>

@endsection