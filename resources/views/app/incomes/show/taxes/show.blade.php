@extends('app.incomes.show.layout')

@section('tab')

    <div class="max-w-md mb-8">

        <div class="prose prose-green">

            <p>
                Eventually, I'd like to show a graph of the taxes over time.
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
                    @foreach ($taxes as $tax)
                        <tr>
                            <td>
                                {{ $tax->name }}
                            </td>
                            <td class="text-right">
                                <span class="select-all">{{ $tax->presenter()->amount() }}</span>
                            </td>
                            <td>
                                <a href="#">Update</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="select-none">
                    <td>
                        Total
                    </td>
                    <td class="text-right">
                        <span class="select-all">{{ $income->presenter()->estimatedTaxesPerPeriod() }}</span>
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