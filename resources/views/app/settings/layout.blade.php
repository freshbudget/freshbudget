
@extends('layouts.app')

@section('content')

    <section class="flex h-screen overflow-hidden">

        <div class="flex flex-col flex-shrink-0 bg-white border-r border-gray-300 select-none w-96">

            <div class="sticky top-0 px-5 py-4 space-y-4 border-gray-300 backdrop-blur-sm">
        
                <div class="flex items-center justify-between">
        
                    <p class="flex items-center text-xl font-bold text-gray-700">
                        Account Settings
                    </p>
        
                </div>
                
            </div>
        
            <aside class="flex-1 overflow-auto scrollbar-thin scrollbar-track-white scrollbar-thumb-gray-300">
            
                <div class="p-2.5 mb-4 space-y-1.5">
        
                    <a 
                        href="#" 
                        class="block w-full">
                            
                        <div 
                            class="py-2.5 px-3 space-y-1 rounded-lg border hover:bg-gray-100/80 {{ active('ss', 'bg-gray-100/60 border-gray-100', 'border-transparent') }}">
        
                            <h3 class="flex items-center font-semibold">
                               @svg('profile', 'w-4 h-4 mr-2') General
                            </h3>
        
                            <p class="text-sm">
                                Update your personal information, change your avatar, and more.
                            </p>
                            
                        </div>
        
                    </a>
        
                </div>
                
            </aside>
        
        </div>
        
        <main class="w-full h-full overflow-auto">
           @yield('section')  
        </main>

    </section>
    
@endsection
