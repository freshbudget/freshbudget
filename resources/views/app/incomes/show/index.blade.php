@extends('app.incomes.show.layout')

@section('tab')

<div class="prose prose-green">

    <ul>
        <li>
            <a href="{{ route('app.incomes.deductions.create', $income) }}">Create Deductions</a>
        </li>
    </ul>    
    
</div>

@endsection