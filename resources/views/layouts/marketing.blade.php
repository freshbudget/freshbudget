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

                        <x-forms.buttons.secondary as="a" href="{{ route('login') }}">
                            Login
                        </x-forms.buttons.secondary>

                        <x-forms.buttons.primary as="a" href="{{ route('register') }}">
                            Sign up
                        </x-forms.buttons.primary>

                    @endguest

                    @auth

                        <x-forms.buttons.secondary as="a" href="{{ route('app.index') }}">
                            Dashboard
                        </x-forms.buttons.secondary>

                    @endauth
        
                </nav>
            </div>
        
        </header>
        
        <div class="flex-1">
            @yield('page')
        </div>
        
        <footer class="py-10 mt-20 bg-gray-100 sm:py-14">
        
            <div class="max-w-3xl px-4 mx-auto space-y-3 text-gray-500 select-none">
                
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}" class="w-8 h-8 select-none"> 
                    <p class="text-2xl font-semibold text-gray-700">Fresh Budget</p>
                </div>
    
                <p>
                    We've helped 5+ people manage their finances and we can help you too!
                </p>
    
                <p class="text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name') }} &mdash; 
                    <a href="{{ route('terms') }}" class="hover:underline">Terms of Use</a>
                    &mdash; 
                    <a href="{{ route('privacy') }}" class="hover:underline">Privacy Policy</a>
                    &mdash; 
                    <a href="{{ route('faq') }}" class="hover:underline">FAQ</a>
                    &mdash; 
                    <a href="{{ route('blog') }}" class="hover:underline">Blog</a>
                </p>
        
            </div>
        
        </footer>
        
    </div>

@endsection