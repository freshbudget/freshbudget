@extends('app.incomes.layout')

@section('section')

    <div class="pb-6 overflow-hidden border-b border-gray-300">

        <h3 class="p-6 text-3xl font-bold tracking-tight truncate select-none">
            {{ $income->name }}
        </h3>

        <div class="px-6">
            Url, owner, links, etc
        </div>
        
    </div>

    <div class="p-6">

        @yield('tab')

    </div>

@endsection