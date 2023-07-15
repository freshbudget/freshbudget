@extends('layouts.app')

@section('page::title', 'Dashboard')

@section('content')

<div class="sticky top-0 w-full bg-white border-b border-gray-300 select-none">

    <nav class="flex w-full px-4 -mb-px space-x-3">

        <button class="block px-1 text-sm py-3 border-b-2 {{ active('app.index', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
            Feed
        </button>

        <button class="block px-1 text-sm py-3 border-b-2 {{ active('app.index2', 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
            Charts &amp; Graphs
        </button>

    </nav>

</div>

<div class="max-w-3xl px-4 mx-auto my-10">
    Todo...
</div>

@endsection