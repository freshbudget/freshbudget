@extends('layouts.app')

@section('page::title', 'Incomes')

{{-- @section('content')

    <div class="max-w-4xl p-6 px-4 mx-auto prose prose-green">

        <p>You currently have active {{ $incomes->count() }} {{ str('income')->plural($incomes->count()) }}, bringing in a estimated monthly amount of ${{ $incomes->sum('estimated_net_per_month') }}.</p>

        <blockquote>
            Show a bar chart of how each income contributes to the total monthly income.
        </blockquote>

        <p>
            Last month, you estimated you would earn $3,120.27, but you actually earned $3,120.27. This is a difference of $0.00, or 0.00%.
        </p>

        <blockquote>
            Show a bar chart of the estimated vs actual income for the last month.
        </blockquote>

        <p>
            This month, you have estimated you will earn $3,120.27. You have earned $0.00 so far. This is a difference of $3,120.27, or 100%.
        </p>

        <p>
            Your next expected income is your <strong>Salary</strong>, which is due on the 15th of this month and is estimated to be $3,120.27.
        </p>

        <blockquote>
            Show a bar chart of the estimated vs actual income for the current month.
        </blockquote>

        <p>
            Year to date, you have earned $3,120.27, which is 16% of what you estimate you will earn this year.
        </p>

    </div>

@endsection --}}

@section('content')

    <div class="max-w-5xl px-4 py-8 mx-auto" x-data="{ search: '' }">

        <div class="flex items-center justify-between mb-8">
            
            <div>
                <x-forms.input type="search" x-model="search" placeholder="Search..."  />
            </div>

            <x-forms.buttons.secondary 
                as="a" 
                class="flex items-center"
                href="{{ route('app.incomes.create') }}">
                @svg('banknotes', 'w-4 h-4 mr-1.5') Create Income
            </x-forms.buttons.secondary>
        </div>

        <div class="grid grid-cols-3 gap-4">
            @foreach ($incomes as $income)

                <div
                    class="relative p-4 bg-white border border-gray-300 rounded shadow-sm focus-within:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus-within:outline-none focus-within:shadow" 
                    x-bind:class="{
                        'hidden' : ! (search == '' || '{{ $income->name }}'.toLowerCase().includes(search.toLowerCase()))
                    }">
                    <a href="{{ route('app.incomes.show', $income) }}" class="absolute inset-0 rounded focus:outline-none">
                        <span class="sr-only">View income</span>
                    </a>
                    <h2 class="text-lg font-semibold truncate">{{ $income->name }}</h2>
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
                
            @endforeach
        </div>
        
    </div>
    
@endsection