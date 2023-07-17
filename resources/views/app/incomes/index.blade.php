@extends('layouts.app')

@section('page::title', 'Incomes')

@section('content')

    <div class="max-w-5xl px-4 py-8 mx-auto" x-data="{ search: '' }">

        <!-- header, search and create -->
        <div class="flex items-center justify-between mb-8">
            
            <div>
                <x-forms.input 
                    type="search" 
                    x-model="search" 
                    placeholder="Search..."  
                    x-on:keydown.escape.window="search=''" />
            </div>

            <x-forms.buttons.secondary 
                as="a" 
                class="flex items-center"
                href="{{ route('app.incomes.create') }}">
                @svg('banknotes', 'w-4 h-4 mr-1.5') Create Income
            </x-forms.buttons.secondary>

        </div>

        <!-- incomes grid -->
        <div class="grid grid-cols-3 gap-4">

            @foreach ($incomes as $income)

                <x-context-menu x-bind:class="{ 'hidden' : ! (search == '' || '{{ e($income->name) }}'.toLowerCase().includes(search.toLowerCase())) }">

                    <div class="relative p-4 bg-white border border-gray-300 rounded shadow-sm focus-within:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus-within:outline-none focus-within:shadow">

                        <a 
                            href="{{ route('app.incomes.show', $income) }}" 
                            class="absolute inset-0 rounded focus:outline-none">
                            <span class="sr-only">View {{ $income->name  }} income</span>
                        </a>

                        <h2 class="text-lg font-semibold truncate">
                            {{ $income->name }}
                        </h2>

                        <div class="flex items-center mt-1.5 space-x-2.5 text-sm text-gray-500">

                            <div class="flex items-center">
                                @svg('info', 'w-4 h-4 mr-1') {{ $income->type->name }}
                            </div>

                            <div class="flex items-center">
                                @svg('calendar', 'w-4 h-4 mr-1') {{ $income->frequency }}
                            </div>

                            <div class="flex items-center">
                                @svg('banknotes', 'w-4 h-4 mr-1') {{ $income->presenter()->estimatedNetPerPeriod() }}
                            </div>

                        </div>

                    </div>

                    <x-slot:options>
                        
                        <x-context-menu.option as="a" href="{{ route('app.incomes.entries.create', $income) }}">
                            Log Entry
                        </x-context-menu.option>

                        <x-context-menu.option as="a" href="{{ route('app.incomes.edit', $income) }}">
                            Settings
                        </x-context-menu.option>

                    </x-slot:options>
                
                </x-context-menu>

            @endforeach

        </div>
        
    </div>
    
@endsection