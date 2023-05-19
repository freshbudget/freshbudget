@extends('app.incomes.show.layout')

@section('tab')

    <ul>
        <li>
            <a href="{{ route('app.incomes.entitlements.create', $income) }}">Create Entitlements</a>
        </li>
        <li>
            <form action="{{ route('app.incomes.destroy', $income) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>
        </li>
    </ul>    

@endsection