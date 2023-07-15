@extends('app.budgets.layout')

@section('section')

    <h3 class="px-6 pt-6 text-3xl font-bold tracking-tight select-none">
        Your Budgets
    </h3>

    <div class="max-w-xl p-6 mb-8 prose prose-green">
        
        <p>
            You are currently a member of {{ $budgets->count() }} budgets, you can select a budget from the sidebar to view its details.
        </p>

        <p>
            As a reminder, budgets are a way to group your resources and collaborate with others. You can create as many budgets as you like and invite as many people as you like to each budget. 
        </p>
        
    </div>

@endsection