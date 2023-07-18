@extends('layouts.marketing')

@push('head::end')
    <style>[x-cloak] { display: none !important; }</style>
@endpush

@push('body::end')
    @vite(['resources/js/marketing.js'])
@endpush

@php
$questions = [
    [
        'title' => 'Do you ever store my credit card information?',
        'answer' => 'No, we never store your credit card information. We use Stripe to process all payments. Stripe is a PCI Service Provider Level 1 which is the highest grade of payment processing security. You can rest assured that your information is safe and secure.',
    ],
    [
        'title' => 'Can I get a refund?',
        'answer' => 'Yes, we offer a 30-day money back guarantee. If you are not satisfied with your purchase, you can contact us within 30 days of your purchase for a full refund.',
],
    [
        'title' => 'Do you offer any discounts?',
        'answer' => 'Yes, we plan to offer student, teacher, first responder, and military discounts in the future. If you are interested in one of these discounts, please contact us.',
],
    [
        'title' => 'What type of accounting method do you use?',
        'answer' => 'Behind the scenes, we use double-entry accounting. However, we do not require you to know anything about accounting to use our software. We make it easy for you to manage your finances without having to worry about account, credits, debits or any other formal accounting terminology. However, if you are familiar with double-entry accounting, you will feel right at home with our software.',
    ]
]
@endphp

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-center text-gray-800 sm:text-5xl">
            Frequently Asked Questions
        </h2>

    </main>

    <section class="max-w-3xl px-4 mx-auto my-12 divide-y divide-gray-900/10">

        @foreach ($questions as $question)
            
            <div x-data="{ open: false }" class="py-3">
                
                <dt>
                    <button x-on:click="open=!open" type="button" class="flex items-start justify-between w-full p-2 -mx-2 text-left text-gray-900 rounded-lg hover:bg-gray-100">
                    
                    <span class="text-base font-semibold leading-7">{!! $question['title'] !!}</span>
                    
                    <div class="flex items-center h-7">
                        
                        <span x-show="!open">
                            @svg('plus', 'w-6 h-6', ['aria-hidden' => 'true'])
                        </span>
                        
                        <span x-cloak x-show="open">
                            @svg('minus', 'w-6 h-6', ['aria-hidden' => 'true'])                            
                        </span>

                    </div>

                    </button>

                </dt>

                <dd class="mt-2" x-show="open" x-cloak>
                    <p class="text-base leading-7 text-gray-600">{!! $question['answer'] !!}</p>
                </dd>

            </div>

        @endforeach

    </section>
    
@endsection