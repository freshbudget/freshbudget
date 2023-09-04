@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('app.expenses.index'))
@section('page::title', 'Create Expense')

@section('content')

    <div class="max-w-3xl p-4 mx-auto mb-8">
        
       @livewire('panels.expenses.create-expense-panel')

    </div>
    
@endsection