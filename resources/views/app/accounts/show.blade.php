@extends('layouts.app')

@section('page::title', $account->name)
@section('breadcrumbs', Breadcrumbs::render('app.accounts.index'))

@section('content')

{{ $account->name }} asset account

@endsection