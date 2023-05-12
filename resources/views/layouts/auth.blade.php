@extends('layouts.livewire')

@push('body::classes', 'selection:bg-gray-300')

@section('page')

    <div class="absolute inset-0 flex items-center justify-center w-full h-full bg-white">

        <div class="flex flex-col items-center max-w-[375px] w-full">

            <a href="{{ route('welcome') }}" class="px-3 py-2.5 mb-4 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner select-none">
                <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" class="w-12 h-12">
            </a>

            @yield('content')

        </div>
    </div>

@endsection