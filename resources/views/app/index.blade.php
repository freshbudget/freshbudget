@extends('layouts.app')

@section('page::title', 'Dashboard')

@section('content')

    <div class="sticky top-0">

        <x-navbar :links="[
            [
                'label' => 'Overview',
                'route' => route('app.index'),
                'active' => 'app.index'
            ]
        ]" />

    </div>

    <div class="prose md:my-10 my-6 mx-auto px-4">

        <h1>List of Accounts</h1>

        <table>
            <thead>
                <th>Name</th>
                <th>Type</th>
                <th>Balance</th>
                <th></th>
            </thead>
            <tbody>
                @foreach (currentBudget()->accounts as $account)
                    <tr>
                        <td><x-link href="{{ $account->route('show') }}">{{ $account->name }}</x-link></td>
                        <td>{{ $account->type->displayName() }}</td>
                        <td>TBD</td>
                        <td>Actions</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@endsection