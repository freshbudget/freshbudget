@extends('layouts.base')

@push('head::end')
    @vite(['resources/css/marketing.css'])    
@endpush

@push('body::classes', 'bg-white selection:bg-gray-300')

@section('body')

<div class="flex flex-col w-full h-screen">

    <header class="my-6 select-none sm:my-16">
    
        <div class="flex items-center justify-between max-w-3xl px-4 mx-auto">
            <a href="{{ route('welcome') }}" class="rounded focus:outline-none focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400">
                <h1>
                    <span class="sr-only">{{ config('app.name') }}</span>
                    <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" class="w-10 h-10">
                </h1>
            </a>
    
            <nav class="space-x-2 select-none">

                @guest
                    
                    <a href="{{ route('login') }}" class="px-5 font-semibold inline-block py-2.5 bg-gray-50 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900">Login</a>
        
                    <a href="{{ route('register') }}" class="px-5 font-semibold inline-block py-2.5 bg-green-600 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 border border-green-700 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-green-700 focus:outline-none focus:shadow text-green-50/100 shadow-sm hover:shadow-md hover:text-green-50">Sign up</a>

                @endguest

                @auth

                    <a href="{{ route('app.index') }}" class="px-5 font-semibold inline-block py-2.5 bg-gray-50 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900">
                        Dashboard
                    </a>

                @endauth
    
            </nav>
        </div>
    
    </header>
    
    <div class="flex-1">
        @yield('page')
    </div>
    
    <footer class="mt-20 bg-gray-100 py-14">
    
        <div class="max-w-3xl px-4 mx-auto">
            
            <div class="space-y-3 text-gray-500">
    
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" class="w-8 h-8 select-none"> 
                    <p class="text-2xl font-semibold text-gray-700">Fresh Budget</p>
                </div>
    
                <p>
                    We've helped 5+ people manage their finances and we can help you too!
                </p>
    
                <p class="text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name') }} &mdash; 
                    <a href="{{ route('terms') }}" class="hover:underline">Terms of Service</a>
                    &mdash; 
                    <a href="{{ route('privacy') }}" class="hover:underline">Privacy Policy</a>
                </p>
    
            </div>
    
        </div>
    
    </footer>
    
</div>

@endsection

