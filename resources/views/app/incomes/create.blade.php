@extends('layouts.app')

@section('page::title', 'Add Income')

@section('content')

    <div class="max-w-xl p-6 mx-auto mb-8">
        @livewire('forms.incomes.create-income-form')
    </div>

@endsection