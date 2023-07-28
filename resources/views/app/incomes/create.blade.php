@extends('layouts.app')

@section('page::title', 'Add Income')
@section('breadcrumbs', Breadcrumbs::render('app.incomes.index'))

@section('content')

    <div class="max-w-3xl px-4 mx-auto mb-8">
        @livewire('panels.incomes.create-income-panel')
    </div>

@endsection