@extends('app.budgets.show.layout')

@section('tab')

    <div class="p-6 prose prose-green">
        <ul>
            <li><a href="{{ route('app.budgets.members.invite', $budget) }}">Invite Member</a></li>
        </ul>
    </div>
    
@endsection