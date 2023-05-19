@extends('app.incomes.show.layout')

@section('tab')

    <ul>
        <li>
            <a href="{{ route('app.incomes.entitlements.create', $income) }}">Create Entitlements</a>
        </li>
    </ul>    

@endsection