@extends('app.incomes.show.layout')

@push('head::end')
    {{-- @vite(['resources/js/highcharts.js', 'resources/css/highcharts.css']) --}}
@endpush

@section('tab')

<div class="w-full mx-auto px-4 my-4 max-w-none">

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">

        <section class="border border-gray-300 bg-white rounded aspect-video flex flex-col">
    
            <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
                <h2 class="font-semibold text-gray-700">Recent Activity</h2>
            </header>
        
        
            <div class="flex-1 overflow-y-auto flex flex-col divide-y">
                
                <div class="prose prose-sm px-4 py-2">
                    {{ user()->displayName }} logged income entry on {{ $income->created_at->format('M j, Y') }}
                </div>

                <div class="prose prose-sm px-4 py-2">
                    {{ user()->displayName }} logged income entry for {{ $income->name }} on {{ $income->created_at->format('M j, Y') }}
                </div>
        
            </div>
        
        </section>

        <section class="border border-gray-300 bg-white rounded aspect-video flex flex-col">
    
            <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
                <h2 class="font-semibold text-gray-700">Upcoming Events</h2>
            </header>
        
        
            <div class="p-4 flex-1">
                
                hello
        
            </div>
        
        </section>

        <div class="bg-white border border-gray-300 rounded aspect-video flex items-center justify-center">
            Lifetime Net Income / Earnings
        </div>
    
        <div class="bg-white border border-gray-300 rounded aspect-video flex items-center justify-center">
            Lifetime Entitlements, Deductions, Taxes
        </div>
        
        <div class="bg-white border border-gray-300 rounded aspect-video flex items-center justify-center">
            This Month's Net Income / Earnings
        </div>

    </div>

</div>

@endsection