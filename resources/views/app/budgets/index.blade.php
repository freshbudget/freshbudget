@extends('layouts.app')

@section('page::title', 'Budgets')

@section('content')

<div class="max-w-4xl px-4 py-8 mx-auto" x-data="{
    search: '',
}">

    <div class="flex items-center justify-between mb-8">
        
        <div>
            <x-forms.input type="search" x-model="search" placeholder="Search..."  />
        </div>

        <x-forms.buttons.secondary 
            as="a" 
            class="flex items-center"
            href="{{ route('app.budgets.create') }}">
            @svg('stack', 'w-4 h-4 mr-1.5') Create Budget
        </x-forms.buttons.secondary>
    </div>

    <div class="grid grid-cols-3 gap-4">
        @foreach ($budgets as $budget)
            <a href="{{ route('app.budgets.show', $budget) }}"
                class="flex items-center p-4 bg-white border border-gray-300 rounded shadow-sm" 
                x-bind:class="{
                    'hidden' : ! (search == '' || '{{ $budget->name }}'.toLowerCase().includes(search.toLowerCase()))
                }">
                {{ $budget->name }}
            </a>
        @endforeach
    </div>
    
</div>
    
    @endsection