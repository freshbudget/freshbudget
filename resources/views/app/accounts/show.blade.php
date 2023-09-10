@extends('layouts.app')

@section('page::title', $account->name)
@section('breadcrumbs', Breadcrumbs::render('app.accounts.index'))

@section('content')

<div class="mx-auto px-4 prose">

    <h1>{{ $account->name }}</h1>

    <ul>
        <li>Institution: {{ $account->institution?->name }}</li>
        <li>URL: <a href="{{ $account->url }}" target="_blank">{{ $account->url }}</a></li>
    </ul>

</div>

@endsection