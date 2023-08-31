@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl selection:text-green-600 selection:bg-transparent">
            Personal finance and budgeting doesn't have to be hard. 
        </h2>

        <p class="my-8 text-base text-gray-700 sm:my-10 sm:text-lg">
            Budgeting software has gotten too complex. With Fresh Budget we are 1) going back to basics, 2) privacy focused and 3) open source too.
        </p>

        <div class="flex flex-col items-center space-y-2 select-none sm:space-x-4 sm:flex-row sm:space-y-0">

            <x-forms.buttons.primary as="a" href="{{ route('register') }}">
                Get started for free
            </x-forms.buttons.primary>

            <x-forms.buttons.secondary as="a" href="#" class="bg-gray-100">
                Check out live demo
            </x-forms.buttons.secondary>

        </div>

    </main>

    <section class="max-w-3xl px-4 mx-auto mt-20">
        
        <h3 class="text-2xl font-bold tracking-tight text-gray-600">Setup</h3>

        <ul class="mt-5 space-y-2.5 text-base sm:text-lg text-gray-600">
            <li class="flex items-center">
                @svg('banknotes', 'w-6 h-6 mr-4 text-green-500')
                Add one, or multiple, estimated monthly incomes
            </li>
            <li class="flex items-center">
                @svg('creditcard', 'w-6 h-6 mr-4 text-green-500')
                Add expenses and estimated payment amounts
            </li>
            <li class="flex items-center">
                @svg('pluscircle', 'w-6 h-6 mr-4 text-green-500')
                Add accounts to track your all your balances in one place
            </li>
            <li class="flex items-center">
                @svg('userplus', 'w-6 h-6 mr-4 text-green-500')
                Invite additional people to help you manage your budget
            </li>
        </ul>

    </section>

    <section class="max-w-3xl px-4 mx-auto mt-12">
        
        <h3 class="text-2xl font-bold tracking-tight text-gray-600">Upkeep</h3>

        <ul class="mt-5 space-y-2.5 text-base sm:text-lg text-gray-600">
            <li class="flex items-center">
                @svg('scale', 'w-6 h-6 mr-4 text-green-500') Track actual monthly income and expense amounts
            </li>
            <li class="flex items-center">
                @svg('pencilsquare', 'w-6 h-6 mr-4 text-green-500') Mark bills as payed, the amount, and from which account
            </li>
            <li class="flex items-center">
                @svg('fileplus', 'w-6 h-6 mr-4 text-green-500') Add attachments to your incomes, expenses, etc. for easy reference
            </li>
        </ul>

    </section>

    <section class="max-w-3xl px-4 mx-auto mt-12">
        
        <h3 class="text-2xl font-bold tracking-tight text-gray-600">Insights</h3>

        <ul class="mt-5 space-y-2.5 text-base sm:text-lg text-gray-600">
            <li class="flex items-center">
                @svg('barchart', 'w-6 h-6 mr-4 text-green-500') Track estimated net monthly income and expenses
            </li>
            <li class="flex items-center">
                @svg('chart', 'w-6 h-6 mr-4 text-green-500') Track monthly trends and add context as needed
            </li>
            <li class="flex items-center">
                @svg('trendingup', 'w-6 h-6 mr-4 text-green-500') Track general financial health and net worth
            </li>
        </ul>

    </section>

    <section class="max-w-3xl px-4 mx-auto mt-12">
        
        <h3 class="text-2xl font-bold tracking-tight text-gray-600">Outcomes</h3>

        <ul class="mt-5 space-y-2.5 text-base sm:text-lg text-gray-600">
            <li class="flex items-center">
                @svg('bolt', 'w-6 h-6 mr-4 text-green-500') Make informed decisions based on your situation
            </li>
            <li class="flex items-center">
                @svg('users', 'w-6 h-6 mr-4 text-green-500') Ensure everyone understands the financial situation and goals
            </li>
            <li class="flex items-center">
                @svg('smile', 'w-6 h-6 mr-4 text-green-500') Sleep better knowing you have a plan
            </li>
        </ul>

    </section>
    
@endsection

{{-- @push('body::end')
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
@endpush --}}