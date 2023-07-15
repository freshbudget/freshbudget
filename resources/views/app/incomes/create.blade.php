@extends('layouts.app')

@section('page::title', 'Add Income')
@section('breadcrumbs', Breadcrumbs::render('app.incomes.index'))

@section('content')

    <div class="max-w-xl p-6 mx-auto mb-8">
        @livewire('forms.incomes.create-income-form')
    </div>

@endsection