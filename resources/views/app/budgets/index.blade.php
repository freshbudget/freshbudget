@extends('layouts.app')

@section('page::title', 'Budgets')

@section('content')

    <div class="max-w-5xl px-4 py-8 mx-auto" x-data="{ search: '' }">

        <div class="flex items-center justify-between mb-8">
            
            <div>
                <x-forms.input type="search" x-model="search" x-on:keydown.escape.window="search=''" placeholder="Search..."  />
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

                <x-context-menu x-bind:class="{
                    'hidden' : ! (search == '' || '{{ e($budget->name) }}'.toLowerCase().includes(search.toLowerCase()))
                }">
                    
                    <div
                        class="relative p-4 bg-white border border-gray-300 rounded shadow-sm focus-within:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus-within:outline-none focus-within:shadow">
                        
                        <a href="{{ route('app.budgets.show', $budget) }}" class="absolute inset-0 rounded focus:outline-none">
                            <span class="sr-only">View budget</span>
                        </a>

                        <h2 class="text-lg font-semibold truncate">{{ $budget->name }}</h2>

                        <div class="flex items-center mt-1 space-x-2 text-sm text-gray-500">
                            
                            <div class="flex items-center">
                                @svg('users', 'w-4 h-4 mr-1') {{ $budget->members_count }}
                            </div>

                            <div class="flex items-center">
                                @svg('profile', 'w-4 h-4 mr-1') {{ $budget->owner->display_name }}
                            </div>

                            @if(currentBudget()->is($budget))
                                <div class="flex items-center">
                                    @svg('check-circle', 'w-4 h-4 mr-1 text-green-600') Current
                                </div>
                            @endif

                        </div>

                    </div>

                    <x-slot:options>
                        
                        <form action="{{ route('app.budgets.current', $budget) }}" method="post" class="w-full">
                            @csrf
                            <x-context-menu.option as="button" type="submit" class="w-full">
                                Switch to Budget
                            </x-context-menu.option>
                        </form>

                        @can('edit', $budget)
                            <x-context-menu.option as="a" href="{{ route('app.budgets.edit', $budget) }}">
                                Settings
                            </x-context-menu.option>
                        @endcan
                        
                        <x-context-menu.option as="a" href="{{ route('app.budgets.members.index', $budget) }}">
                            Invite Member
                        </x-context-menu.option>

                    </x-slot:options>

                </x-context-menu>
                
            @endforeach
        </div>
        
    </div>
    
@endsection