@extends('app.incomes.show.layout')

@section('tab')

<div class="prose prose-green">

    <form action="{{ route('app.incomes.destroy', $income) }}" method="post">
        @csrf
        @method('delete')
        <button type="submit">Delete</button>
    </form>
    
</div>

@endsection