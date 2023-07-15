@extends('app.budgets.layout')

@section('section')

    <div class="w-full max-w-3xl mx-auto border-b border-gray-300">

        <nav class="flex w-full px-6 -mb-px space-x-0">

            <a href="{{ route('app.budgets.show', $budget) }}" class="block px-3 py-3 border-b-2 {{ active('app.budgets.show', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Members
            </a>

            <a href="{{ route('app.budgets.edit', $budget) }}" class="block px-3 py-3 font-semibold border-b-2 {{ active('app.budgets.edit', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Settings
            </a>

        </nav>

    </div>

    <div class="max-w-3xl mx-auto">        
        @yield('tab')
    </div>

@endsection