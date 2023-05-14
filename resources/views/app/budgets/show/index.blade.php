@extends('app.budgets.show.layout')

@section('tab')
    <div class="p-6">
        @livewire('tables.budgets.members-table')        
    </div>
@endsection