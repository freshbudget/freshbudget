@extends('layouts.marketing')

@section('page')

    <h1>Invitation Accepted</h1>

    <p>
        You have accepted the invitation. You can now access the budget by visiting your <a href="{{ route('app.budgets.index') }}">budgets</a> page.
    </p>
    
@endsection