@extends('layouts.app')

@section('page::title', 'Incomes')

@section('content')

    <div class="max-w-6xl px-4 py-8 mx-auto" x-data="{ search: '' }">

        <div class="grid grid-cols-3 gap-4 select-none mb-8">
            
            @livewire('income-overview')
            
            <div class="relative p-4 bg-white border border-gray-300 rounded shadow-sm focus-within:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus-within:outline-none focus-within:shadow h-32"></div>

            <div class="relative p-4 bg-white border border-gray-300 rounded shadow-sm focus-within:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus-within:outline-none focus-within:shadow h-32"></div>

        </div>

        <div class="bg-gray-300 h-[1.5px] rounded my-8"></div>

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
        <div class="grid grid-cols-3 gap-4 select-none">

            @forelse ($incomes as $income)

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

                        @if($income->url)
                            <x-context-menu.option as="a" href="{{ $income->url }}" target="_blank">
                                Visit URL
                            </x-context-menu.option>
                        @endif

                        <x-context-menu.option as="a" href="{{ route('app.incomes.edit', $income) }}">
                            Settings
                        </x-context-menu.option>

                    </x-slot:options>
                
                </x-context-menu>

            @empty

                <div class="rounded bg-white select-none flex flex-col items-center justify-center w-full col-span-3 p-8 space-y-3 border border-gray-300">
                    @svg('plus-circle', 'w-12 h-12 mx-auto text-gray-300')
                    <p class="text-gray-500">You haven't added any incomes yet</p>
                </div>

            @endif

        </div>
        
    </div>
    
@endsection