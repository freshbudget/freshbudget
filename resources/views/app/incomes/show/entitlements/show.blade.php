@extends('app.incomes.show.layout')

@section('tab')

    <div class="mx-auto px-8 my-8">

        <div class="grid lg:grid-cols-3 grid-cols-1 md:grid-cols-2 gap-4">

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
                            text: '{{ e($income->name) }} Entitlements (per period)'
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
                            @foreach ($entitlements->sortBy('amount') as $entitlement)
                                {
                                    name: '{{ e($entitlement->name) }}',
                                    data: [{{ $entitlement->amount / 100 }}]
                                },
                            @endforeach
                        ]
                    });
                "
                class="bg-white rounded border border-gray-300 aspect-video w-full">

            </div>

            <div
            x-data="{
                chart: null, 
            }"
            x-init="
                chart = Highcharts.chart($el, {
                    chart: {
                        type: 'spline'
                    },
                    title: {
                        text: '{{ e($income->name) }} Entitlements over time'
                    },
                    xAxis: {
                        type: 'datetime',
                        title: {
                            text: 'Date'
                        }
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
                    series: [
                        @foreach ($entitlements as $entitlement)
                            {
                                name: '{{ e($entitlement->name) }}',
                                data: [
                                    [Date.UTC({{ $entitlement->start_date->format('Y, m, d') }}), {{ $entitlement->amount / 100 }}],
                                    [Date.UTC(2023, 9, 24), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 9, 27), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 9, 30), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 10,  3), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 10,  6), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 10,  9), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 10, 12), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 10, 15), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 10, 18), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 10, 21), {{ rand(200, 1000) }}],
                                    [Date.UTC(2023, 10, 24), {{ rand(200, 1000) }}],
                                ]
                            }, 
                        @endforeach
                    ]
                });
            "
            class="bg-white rounded border border-gray-300 aspect-video w-full">

        </div>

            <div class="prose prose-green">
                <table>
                    <thead class="select-none">
                        <td>
                            Name
                        </td>
                        <td class="pr-2 text-right">
                            Amount
                        </td>
                        <td class="pr-2 text-right">
                            Start Date
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
                                <td class="text-right">
                                    {{ $entitlement->start_date->format('Y-m-d') }}
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

    </div>

@endsection