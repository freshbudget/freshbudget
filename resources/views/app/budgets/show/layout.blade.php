@extends('app.budgets.layout')

@section('section')

    <div class="w-full border-b border-gray-300">
        
        <h3 class="px-6 pt-6 pb-4 text-3xl font-bold tracking-tight select-none">
            {{ $budget->name }}
        </h3>

        <nav class="flex w-full px-6 -mb-px space-x-0">

            <a href="#" class="block px-3 py-3 font-semibold border-b-4 border-gray-400">
                Members
            </a>

            <a href="#" class="block px-3 py-3 font-semibold border-b-4 border-transparent hover:border-gray-300">
                Settings
            </a>

        </nav>

    </div>

    <div>        
        @yield('tab')
    </div>

@endsection