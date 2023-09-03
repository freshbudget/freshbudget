@extends('layouts.app')

@section('page::title', 'Dashboard')

@section('content')

    <div class="sticky top-0">

        <x-navbar :links="[
            [
                'label' => 'Overview',
                'route' => route('app.index'),
                'active' => 'app.index'
            ],
            [
                'label' => 'Timeline',
                'route' => '#',
                'active' => 'app.index2'
            ],
            [
                'label' => 'Ledger',
                'route' => route('app.ledger.index'),
                'active' => 'app.ledger.index'
            ]
        ]" />

    </div>

@endsection