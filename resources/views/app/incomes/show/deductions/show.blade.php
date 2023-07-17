@extends('app.incomes.show.layout')

@section('tab')

    <div class="max-w-xl mb-8 mx-auto px-4 my-10">

        <div class="prose prose-green">

            <div
                x-data="{
                    chart: null, 
                }"
                x-init="
                    chart = Highcharts.chart($el, {
                        chart: {
                            type: 'bar'
                        },
                        title: {
                            text: '{{ e($income->name) }} Deductions (per period)'
                        },
                        xAxis: {
                            categories: ['Total']
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Amount'
                            }
                        },
                        legend: {
                            reversed: true
                        },
                        plotOptions: {
                            series: {
                                stacking: 'normal',
                                dataLabels: {
                                    enabled: true
                                }
                            }
                        },
                        series: [
                            @foreach ($deductions->sortBy('amount') as $deduction)
                                {
                                    name: '{{ e($deduction->name) }}',
                                    data: [{{ $deduction->amount / 100 }}]
                                },
                            @endforeach
                        ]
                    });
                "
                class="bg-white rounded border border-gray-300 aspect-video w-full">

            </div>

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
                    @foreach ($deductions as $deduction)
                        <tr>
                            <td>
                                {{ $deduction->name }}
                            </td>
                            <td class="text-right">
                                <span class="select-none">$</span>
                                <span class="select-all">{{ number_format($deduction->amount / 100, 2) }}</span>
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
                        <span class="select-all">{{ $income->presenter()->estimatedDeductionsPerPeriod() }}</span>
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