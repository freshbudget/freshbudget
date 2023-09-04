@extends('layouts.app')

@section('page::title', 'Transactions')

@section('content')

    <x-navbar :links="[
        [
            'label' => 'Overview',
            'route' => route('app.transactions.index'),
            'active' => 'app.transactions.index'
        ],
        [
            'label' => 'Create Transaction',
            'route' => route('app.transactions.create'),
            'active' => 'app.transactions.create'
        ]
    ]" />

    <div class="max-w-6xl px-4 py-8 mx-auto prose">

        <ul>
            <li>Todo...</li>
        </ul>
        
    </div>
    
@endsection