@extends('app.incomes.show.layout')

@push('head::end')
    {{-- @vite(['resources/js/highcharts.js', 'resources/css/highcharts.css']) --}}
@endpush

@section('tab')

<div class="w-full mx-auto px-4 my-4 max-w-none">

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-3">

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