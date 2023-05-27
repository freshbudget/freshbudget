@extends('app.incomes.show.layout')

@section('tab')

    <div class="max-w-xl mb-8">

        <div class="prose prose-green">

            <table>
                <thead class="select-none">
                    <td>
                        Name
                    </td>
                    <td>
                        Amount
                    </td>
                    <td>
                        Last Updated
                    </td>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            {{ $entitlement->name }}
                        </td>
                        <td>
                            ${{ number_format($entitlement->amount / 100, 2) }}
                        </td>
                        <td>
                            {{ $entitlement->updated_at->diffForHumans() }}
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

@endsection