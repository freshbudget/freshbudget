@extends('layouts.app')

@section('page::title', 'Accounts')

@section('content')

    <x-navbar :links="[
        [
            'label' => 'Overview',
            'route' => route('app.accounts.index'),
            'active' => 'app.accounts.index'
        ],
        [
            'label' => 'Create Account',
            'route' => route('app.accounts.create'),
            'active' => 'app.accounts.create'
        ]
    ]" />

    <div class="max-w-6xl px-4 py-8 mx-auto prose">

        <h1>List of Accounts</h1>

        <ul>
            
            @foreach ($accounts as $account)
                <li>
                    <x-link href="{{ route('app.accounts.show', $account) }}">
                        {{ $account->name }} ({{ $account->subtype->name }})
                    </x-link>
                </li>
            @endforeach

        </ul>
        
    </div>
    
@endsection