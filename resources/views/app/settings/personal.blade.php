@extends('app.settings.layout')

@section('section')

    <div class="p-6">

        <section class="max-w-2xl bg-white border rounded-lg">

            <div class="px-4 py-2 border-b rounded-t-lg select-none">
                <h3 class="text-lg font-semibold text-gray-600">Personal Information</h3>
            </div>

            <div class="px-2 py-4">

                <div class="space-y-2">

                    <div x-data="{ open: false }">

                        <button x-on:click="open=!open" class="flex items-center justify-between w-full p-3 text-gray-500 rounded-lg cursor-pointer select-none hover:bg-gray-100/70">
    
                            <p>Display Name</p>
                            
                            <div class="flex items-center" x-bind:class="open ? 'rotate-180' : ''">
                                @svg('chevron-down', 'w-4 h-4')
                            </div>
    
                        </button>

                        <div x-cloak x-show="open" class="w-full h-32 p-3 my-2 rounded-lg bg-gray-100/50">
                            Hello Lorem ipsum dolor sit amet consectetur adipisicing elit. Assumenda dicta ut atque esse voluptate! Quam dolor dolorum neque voluptates deserunt! Quisquam accusantium eveniet eaque nesciunt unde laboriosam iusto commodi dignissimos.
                        </div>
                        
                    </div>
                    
                    <div class="mx-2 border-t w-fill"></div>

                    <button class="flex items-center justify-between w-full p-3 rounded-lg cursor-pointer hover:bg-gray-100/70">

                        <p class="text-gray-500">Legal Name</p>

                    </button>
                    
                </div>

            </div>

        </section>

    </div>
    
@endsection