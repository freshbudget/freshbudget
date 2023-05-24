<div x-data="{ search: '' }" class="flex flex-col flex-shrink-0 bg-white border-r border-gray-300 select-none w-96">

    <div class="sticky top-0 px-5 py-4 space-y-4 border-gray-300 backdrop-blur-sm">

        <div class="flex items-center justify-between">

            <p class="flex items-center text-xl font-bold text-gray-700">
                Your Resources and Files
            </p>

        </div>
        
        <div class="flex items-center space-x-2.5 !z-0">

            <x-forms.input type="search" class="flex-1" placeholder="Search Resources" x-model="search" />

            <a href="{{ route('app.files.index') }}" class="flex items-center justify-center p-2.5 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm select-none hover:bg-gradient-to-br hover:from-white hover:to-gray-100 focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow hover:shadow hover:text-gray-900 active:shadow-inner" title="Back to file overview">
                @svg('home', 'w-5 h-5 text-gray-500')
            </a>

            <a href="#" class="flex items-center justify-center p-2.5 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm select-none hover:bg-gradient-to-br hover:from-white hover:to-gray-100 focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow hover:shadow hover:text-gray-900 active:shadow-inner" title="Upload file(s)">
                @svg('plus', 'w-5 h-5 text-gray-500')
            </a>

        </div>
        
    </div>

    <aside class="flex-1 overflow-auto scrollbar-thin scrollbar-track-white scrollbar-thumb-gray-300">
    
        <div class="p-2.5 mb-4">

            
            <div class="space-y-1.5">
                
                <p class="px-3 text-gray-400 uppercase">Incomes</p>
                
                @forelse ($resources as $resource)
                    
                    <a 
                        href="#" 
                        class="block w-full"
                        x-bind:class="{
                        'hidden' : ! (search == '' || '{{ $resource->name }}'.toLowerCase().includes(search.toLowerCase()))
                    }">
                            
                        <div 
                            class="py-2.5 px-3 space-y-1 rounded-lg border hover:bg-gray-100/80 border-transparent">

                            <h3 class="font-semibold">{{ $resource->name }}</h3>
                            
                            <p class="text-sm italic">
                                Income / Expense / Account / Etc.
                            </p>
                            
                        </div>

                    </a>

                @empty

                    <div class="py-2.5 px-3 rounded-lg">
                        <p class="text-sm text-center text-gray-400 select-none">No resources added yet.</p>
                    </div>
                    
                @endforelse

            </div>     

        </div>
        
    </aside>

</div>