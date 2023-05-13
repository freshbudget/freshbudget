@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl selection:text-green-600 selection:bg-transparent">
            Personal finance and budgeting doesn't have to be complicated. 
        </h2>

        <p class="my-10 text-lg text-gray-700">
            Budgeting software has gotten too complex. With Fresh Budget we are going back to basics, oh and we are making it work for couples / families.
        </p>

        <div class="flex items-center space-x-4 select-none">

            <a href="{{ route('register') }}" class="px-5 font-semibold inline-block py-2.5 bg-green-600 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 border border-green-700 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-green-700 focus:outline-none focus:shadow text-green-50/100 shadow-sm hover:shadow-md hover:text-green-50 active:shadow-inner">
                Get started for free
            </a>

            <a href="#" class="px-5 font-semibold inline-block py-2.5 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner">
                Check out live demo
            </a>

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