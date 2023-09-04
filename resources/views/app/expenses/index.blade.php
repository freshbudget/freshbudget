@extends('layouts.app')

@section('page::title', 'Expenses')

@section('content')

    <x-navbar :links="[
        [
            'label' => 'Overview',
            'route' => route('app.expenses.index'),
            'active' => 'app.expenses.index'
        ],
        [
            'label' => 'Create Expense',
            'route' => route('app.expenses.create'),
            'active' => 'app.expenses.create'
        ]
    ]" />

    <div class="max-w-6xl px-4 py-8 mx-auto prose">

        <ul>
            
            @foreach ($expenses as $expense)
                <li>
                    <x-link href="#">
                        {{ $expense->name }}
                    </x-link>
                </li>
            @endforeach

        </ul>
        
    </div>
    
@endsection