@extends('layouts.app')

@section('page::title', 'Add Account')
@section('breadcrumbs', Breadcrumbs::render('app.accounts.index'))

@section('content')

    <div class="max-w-3xl px-4 mx-auto mb-8">
        @livewire('panels.accounts.create-account-panel')
    </div>

@endsection