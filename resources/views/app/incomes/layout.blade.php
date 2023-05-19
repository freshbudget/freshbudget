@extends('layouts.app')

@section('content')

    <section class="flex h-screen overflow-hidden">

        <div x-data="{ search: '' }" class="flex flex-col flex-shrink-0 bg-white border-r border-gray-300 select-none w-96">
            
            <div class="sticky top-0 z-10 px-5 py-4 space-y-4 border-gray-300 backdrop-blur-sm">

                <p class="flex items-center text-xl font-bold text-gray-700">
                    Incomes
                </p>
                
                <div class="flex items-center space-x-2.5">

                    <x-forms.input type="search" class="flex-1" placeholder="Search" x-model="search" />

                    <a href="{{ route('app.incomes.index') }}" class="flex items-center justify-center p-2.5 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm select-none hover:bg-gradient-to-br hover:from-white hover:to-gray-100 focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow hover:shadow hover:text-gray-900 active:shadow-inner" title="See income overview">
                        @svg('home', 'w-5 h-5 text-gray-500')
                    </a>

                    <a href="{{ route('app.incomes.create') }}" class="flex items-center justify-center p-2.5 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm select-none hover:bg-gradient-to-br hover:from-white hover:to-gray-100 focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow hover:shadow hover:text-gray-900 active:shadow-inner" title="Add income">
                        @svg('plus', 'w-5 h-5 text-gray-500')
                    </a>

                </div>
                
            </div>

            <aside class="flex-1 overflow-auto scrollbar-thin scrollbar-track-white scrollbar-thumb-gray-300">
            
                <div class="p-2.5 mb-4">
                    
                    <div x-ref="incomeList" class="space-y-1.5">

                        @foreach ($incomes as $income)
                            
                            <a 
                                href="{{ route('app.incomes.show', $income) }}" 
                                class="block w-full" 
                                x-on:contextmenu="event.preventDefault(); console.log('right click')"
                                x-bind:class="{
                                'hidden' : ! (search == '' || '{{ $income->name }}'.toLowerCase().includes(search.toLowerCase()))
                            }">
                                    
                                <div 
                                    class="py-2.5 px-3 space-y-1 rounded-lg border hover:bg-gray-100/80 {{ active([
                                        route('app.incomes.show', $income),
                                    ], 'bg-gray-100/60 border-gray-100', 'border-transparent') }}">

                                    <h3 class="font-semibold">{{ $income->name }}</h3>
                                    
                                    <p class="text-sm italic">
                                        <span class="text-gray-500">Estimated</span> ${{ $income->estimatedAmountPerPeriod() }}
                                    </p>
                                    
                                </div>

                            </a>
                            
                        @endforeach

                    </div>

                    <div 
                        x-cloak 
                        x-show="search && $refs.incomeList.querySelectorAll('.hidden').length == {{ $incomes->count() }}" 
                        class="py-2.5 px-3 rounded-lg">
                        <p class="text-center text-gray-500 select-none">No incomes found.</p>
                    </div>
                    
    
                </div>
                
            </aside>

        </div>
        
        <main class="w-full h-full overflow-auto">
           @yield('section')  
        </main>

    </section>
    
@endsection