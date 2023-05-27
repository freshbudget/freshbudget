@extends('app.incomes.layout')

@section('section')

    <div class="w-full border-b border-gray-300">
            
        <h3 class="px-6 pt-6 pb-4 text-3xl font-bold tracking-tight select-none">
            {{ $income->name }}
        </h3>
        
        <div class="flex items-center px-6 py-2.5 space-x-4 text-gray-700 select-none">

            <div class="flex items-center space-x-2">
                @svg('banknotes', 'w-4 h-4 text-gray-500') <p>${{ number_format($income->estimated_net_per_period, 2) }}/{{ $income->frequency }}</p>
            </div>

            @if($income->url)
                <div class="flex items-center space-x-2">
                    @svg('link', 'w-4 h-4 text-gray-500') <a href="#">Visit</a>
                </div>
            @endif
            
        </div>

        <nav class="flex w-full px-6 -mx-2 -mb-px space-x-0 select-none">

            <a href="{{ route('app.incomes.show', $income) }}" class="block px-3 py-3 border-b-2 {{ active('app.incomes.show', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Overview
            </a>

            <a href="#" class="block px-3 py-3 border-b-2 {{ active('app.incomes.files', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Transactions
            </a>

            <a href="{{ route('app.incomes.entitlements.show', $income) }}" class="block px-3 py-3 border-b-2 {{ active('app.incomes.entitlements.*', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Entitlements
            </a>

            <a href="#" class="block px-3 py-3 border-b-2 {{ active('app.incomes.files', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Taxes
            </a>

            <a href="#" class="block px-3 py-3 border-b-2 {{ active('app.incomes.files', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Deductions
            </a>

            <a href="#" class="block px-3 py-3 border-b-2 {{ active('app.incomes.files', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Attachments
            </a>

            <a href="{{ route('app.incomes.edit', $income) }}" class="block px-3 py-3 border-b-2 {{ active('app.incomes.edit', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Edit
            </a>

        </nav>

    </div>

    <div class="p-6">

        @yield('tab')

    </div>

@endsection