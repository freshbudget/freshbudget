@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto mb-8 sm:mb-20">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl selection:text-green-600 selection:bg-transparent">
            Personal finance and budgeting doesn't have to be complicated.
        </h2>

        <p class="my-10 text-lg text-gray-700">
            Budgeting software has gotten too complex. With Fresh Budget we are going back to basics, oh and we are making it work for couples / families.
        </p>

        <div class="flex items-center space-x-4">

            <a href="{{ route('register') }}" class="px-5 font-semibold inline-block py-2.5 bg-green-600 hover:bg-gradient-to-br hover:from-green-600 hover:to-green-700 border border-green-700 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-green-700 focus:outline-none focus:shadow text-green-50/100 shadow-sm hover:shadow hover:text-green-50">
                Get started for free
            </a>

            <a href="#" class="px-5 font-semibold inline-block py-2.5 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900">
                Check out live demo
            </a>

        </div>

    </main>

    <section class="max-w-3xl px-4 mx-auto">
        Hello
    </section>
    
@endsection