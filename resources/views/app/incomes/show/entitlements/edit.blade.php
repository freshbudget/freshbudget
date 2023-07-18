@extends('app.incomes.show.layout')

@section('tab')

    <div class="max-w-xl mx-auto px-4 my-10">

        <form class="space-y-4" action="{{ route('app.incomes.entitlements.update', ['income' => $income, 'entitlement' => $entitlement]) }}" method="POST">

            @csrf
            @method('PUT')
        
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

            <div class="space-y-2">
                
                <x-forms.label for="reason" required>
                    Reason for change
                </x-forms.label>

                <x-forms.input 
                    type="text" 
                    name="reason" 
                    id="reason"
                    placeholder="Raise, Promotion, etc."
                    required />

                <x-forms.validation-error for="reason" />

            </div>

            <div class="flex items-center justify-end">
                <x-forms.buttons.primary type="submit">
                    Update Entitlement
                </x-forms.buttons.primary>
            </div>

        </form>

    </div>

@endsection