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