@extends('app.incomes.layout')

@section('section')

    <h3 class="px-6 pt-6 text-3xl font-bold tracking-tight select-none">
        Add Income
    </h3>

    <div class="max-w-xl p-6 mb-8">
        
        @livewire('forms.incomes.create-income-form', [
            'types' => $types,
            'frequencies' => $frequencies,
            'users' => $users,
        ])

    </div>

@endsection