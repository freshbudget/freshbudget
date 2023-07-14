@extends('app.incomes.show.layout')

@section('tab')

<div class="prose prose-green">

    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Veniam magni animi ducimus neque! Corporis deserunt sit deleniti earum odio facere sunt similique reiciendis officia atque, voluptates exercitationem, omnis voluptatibus nihil.

    <ul>
        <li><a href="{{ route('app.incomes.entries.create', $income) }}">Log income entry</a></li>
    </ul>
    
</div>

@endsection