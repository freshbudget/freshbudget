@extends('layouts.marketing')

@push('head::end')
    <style>[x-cloak] { display: none !important; }</style>
@endpush

@push('body::end')
    @vite(['resources/js/marketing.js'])
@endpush

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-center text-gray-800 sm:text-5xl">
            Frequently Asked Questions
        </h2>

    </main>

    <section class="max-w-3xl px-4 mx-auto my-12 space-y-6 divide-y divide-gray-900/10">
               
        <div x-data="{ open: false }">
            
            <dt>
                <button x-on:click="open=!open" type="button" class="flex items-start justify-between w-full p-2 -mx-2 text-left text-gray-900 rounded-lg hover:bg-gray-100">
                
                <span class="text-base font-semibold leading-7">What&#039;s the best thing about Switzerland?</span>
                
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
                <p class="text-base leading-7 text-gray-600">I don&#039;t know, but the flag is a big plus. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas cupiditate laboriosam fugiat.</p>
            </dd>

        </div>
    

    </section>
    
@endsection