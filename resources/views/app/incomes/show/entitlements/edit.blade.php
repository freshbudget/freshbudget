@extends('app.incomes.show.layout')

@section('tab')

    <div class="max-w-xl mb-8">

        <form class="space-y-4">

            <div class="space-y-2">
                
                <x-forms.label for="name">
                    Name
                </x-forms.label>

                <x-forms.input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ $entitlement->name }}" />

                <x-forms.validation-error for="name" />

            </div>

            <div class="space-y-2">
                
                <x-forms.label for="amount">
                    Amount
                </x-forms.label>

                <x-forms.input 
                    type="text" 
                    name="amount" 
                    id="amount"
                    x-data
                    x-mask:dynamic="$money($input)"
                    value="{{ $entitlement->amount / 100 }}" />

                <x-forms.validation-error for="amount" />

            </div>

            <div class="space-y-2">
                
                <x-forms.label for="start_date">
                    Start Date
                </x-forms.label>

                <x-forms.input 
                    type="date" 
                    name="start_date" 
                    id="start_date"
                    value="{{ $entitlement->start_date->format('Y-m-d') }}" />

                <x-forms.validation-error for="start_date" />

            </div>

            <div class="space-y-2">
                
                <x-forms.label for="end_date">
                    End Date
                </x-forms.label>

                <x-forms.input 
                    type="date" 
                    name="end_date" 
                    id="end_date"
                    value="{{ $entitlement->end_date?->format('Y-MM-dd') }}" />

                <x-forms.validation-error for="end_date" />

            </div>

        </form>

        <div class="my-8 prose prose-green">

            <table>
                <thead class="select-none">
                    <td>
                        Name
                    </td>
                    <td>
                        Amount
                    </td>
                    <td>
                        Start Date
                    </td>
                    <td>
                        End Date
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
                            {{ $entitlement->start_date->format('d-M-Y') }}
                        </td>
                        <td>
                            @if ($entitlement->end_date)
                                {{ $entitlement->end_date->format('d-M-Y') }}
                            @else
                                &nbsp;
                            @endif
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