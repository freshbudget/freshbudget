@extends('layouts.app')

@section('page::title', $expense->name)
@section('breadcrumbs', Breadcrumbs::render('app.expenses.index'))

@section('content')

{{ $expense->name }} expense account

@endsection