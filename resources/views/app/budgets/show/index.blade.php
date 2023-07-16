@extends('app.budgets.show.layout')

@section('page::title', $budget->name)
@section('breadcrumbs', Breadcrumbs::render('app.budgets.index'))

@section('tab')

    // Tab content
    
@endsection