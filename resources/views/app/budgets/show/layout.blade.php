@extends('layouts.app')

@section('page::title', $budget->name)
@section('breadcrumbs', Breadcrumbs::render('app.budgets.index'))

@section('content')

    <div class="sticky top-0 w-full bg-white border-b border-gray-300 select-none">

        <nav class="flex w-full px-4 -mb-px space-x-3">

            <a href="{{ route('app.budgets.show', $budget) }}" class="block px-1 text-sm py-3 border-b-2 {{ active('app.budgets.show', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                General
            </a>

            <a href="{{ route('app.budgets.show', $budget) }}" class="block px-1 text-sm py-3 border-b-2 {{ active('app.budgets.sshow', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Members
            </a>

            <a href="{{ route('app.budgets.edit', $budget) }}" class="block px-1 text-sm py-3 font-semibold border-b-2 {{ active('app.budgets.edit', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                Settings
            </a>

        </nav>

    </div>

    <div class="max-w-3xl mx-auto h-[9000px]">        
        @yield('tab')
    </div>

@endsection