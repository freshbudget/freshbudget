@extends('layouts.base')

@push('head::end')
    @vite(['resources/css/marketing.css'])    
@endpush

@push('body::end')
    @vite(['resources/js/marketing.js'])    
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
@endpush

@push('body::classes', 'bg-white selection:bg-gray-300')

@section('body')

    <header class="my-6 select-none sm:my-16">

        <div class="flex items-center justify-between max-w-3xl px-4 mx-auto">
            <a href="{{ route('welcome') }}" class="rounded focus:outline-none focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400">
                <h1>
                    <span class="sr-only">{{ config('app.name') }}</span>
                    <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" class="w-10 h-10">
                </h1>
            </a>

            <nav class="space-x-2 select-none">
                <a href="{{ route('login') }}" class="px-5 font-semibold inline-block py-2.5 bg-gray-50 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900">Login</a>

                <a href="{{ route('register') }}" class="px-5 font-semibold inline-block py-2.5 bg-green-600 hover:bg-gradient-to-br hover:from-green-600 hover:to-green-700 border border-green-700 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-green-700 focus:outline-none focus:shadow text-green-50/100 shadow-sm hover:shadow hover:text-green-50">Sign up</a>

            </nav>
        </div>

    </header>
    
    @yield('page')

@endsection

@push('body::end')
    <script>
        function fireConfetti(event) {
            confetti({
                particleCount: 150,
                spread: 90,
                origin: {
                    y: event.clientY / window.innerHeight,
                    x: event.clientX / window.innerWidth
                }
            });
        }
    </script>    
@endpush