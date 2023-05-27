@extends('app.incomes.show.layout')

@section('tab')

    <div class="max-w-md mb-8">

        <div class="prose prose-green">

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
                    @foreach ($income->entitlements as $entitlement)
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
                        <span class="select-none">$</span>
                        <span class="select-all">{{ number_format($income->entitlements->sum('amount') / 100, 2) }}</span>
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