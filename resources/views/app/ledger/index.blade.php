@extends('layouts.app')

@section('page::title', 'Budget Ledger')

@section('content')

    <div class="sticky top-0">

        <x-navbar :links="[
            [
                'label' => 'Overview',
                'route' => route('app.ledger.index'),
                'active' => 'app.ledger.index'
            ],
        ]" />

    </div>

    <div class="prose my-10 mx-auto">

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
                        <td><x-link href="{{ route('app.accounts.show', $account) }}">{{ $account->name }}</x-link></td>
                        <td>{{ $account->type }}</td>
                        <td>TBD</td>
                        <td>Actions</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table>
            <thead>
                <th>Date</th>
                <th>From</th>
                <th>To</th>
                <th>Amount</th>
                <th>Type</th>
            </thead>
            <tbody>

                @foreach($ledger->transactions as $transaction)
                    <tr>
                        <td>
                            {{ $transaction->created_at->format('d/m/Y') }}
                        </td>
                        <td>
                            {{ $transaction->from->name }}
                        </td>
                        <td>
                            {{ $transaction->to->name }}
                        </td>
                        <td class="tabular-nums">
                            {{ $transaction->amount }}
                        </td>
                        <td>
                            {{ $transaction->type }}
                        </td>
                    </tr>
                @endforeach

            </tbody>
            
            <tfoot>
    
            </tfoot>
        </table>

    </div>

@endsection