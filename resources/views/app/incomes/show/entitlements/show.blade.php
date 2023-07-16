@extends('app.incomes.show.layout')

@section('tab')

    <div class="max-w-lg mb-8 mx-auto px-4 my-10">

        <div class="prose prose-green">

            <p>
                Eventually, I'd like to show a graph of the entitlements over time.
            </p>

            <table>
                <thead class="select-none">
                    <td>
                        Name
                    </td>
                    <td class="pr-2 text-right">
                        Amount
                    </td>
                    <td>
                        Actions
                    </td>
                </thead>
                <tbody>
                    @foreach ($entitlements as $entitlement)
                        <tr>
                            <td>
                                {{ $entitlement->name }}
                            </td>
                            <td class="text-right">
                                <span class="select-none">$</span>
                                <span class="select-all">{{ number_format($entitlement->amount / 100, 2) }}</span>
                            </td>
                            <td>
                                <a href="{{ route('app.incomes.entitlements.edit', [$income, $entitlement]) }}">Update</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="select-none">
                    <td>
                        Total
                    </td>
                    <td class="text-right">
                        <span class="select-all">{{ $income->presenter()->estimatedEntitlementsPerPeriod() }}</span>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tfoot>
            </table>

        </div>

    </div>

@endsection