@extends('app.incomes.show.layout')

@section('tab')

<div class="prose prose-green">

    <ul>
        <li>
            <a href="{{ route('app.incomes.entitlements.create', $income) }}">Create Entitlements</a>
        </li>
        <li>
            <a href="{{ route('app.incomes.taxes.create', $income) }}">Create Taxes</a>
        </li>
        <li>
            <a href="{{ route('app.incomes.deductions.create', $income) }}">Create Deductions</a>
        </li>
        <li>
            <form action="{{ route('app.incomes.destroy', $income) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit">Delete</button>
            </form>
        </li>
    </ul>    
    
</div>

@endsection