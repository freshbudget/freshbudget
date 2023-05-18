<div class="flex flex-col w-full h-full select-none">

    <!-- Budget selector -->
    <div class="p-4">

        <div x-data="{ open: false }" x-on:keydown.escape.window="open=false" class="relative">
    
            <button x-on:click="open = !open" type="button" class="px-2.5 font-semibold py-2 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner w-full flex items-center justify-between">
    
                <span class="truncate">{{ auth()->user()->currentBudget->name }}</span>  
    
                <span class="flex items-center justify-center w-5 h-5">@svg('chevron-down', 'w-full h-full text-gray-500')</span>
                
            </button>
    
            <template x-teleport="body">
                <div x-cloak x-show="open" class="absolute inset-0 z-10 bg-gray-900/50"></div>
            </template>
    
            <nav x-cloak x-show="open" x-trap="open" x-on:click.outside="open=false" class="absolute left-0 z-50 w-full bg-white border border-gray-300 rounded-lg shadow-md top-12 focus:outline-none" tabindex="-1">
    
                <p class="px-2.5 pt-2 pb-1 text-sm text-gray-500 truncate">
                    {{ auth()->user()->currentBudget->name }}
                </p>
    
                <div class="px-2">
    
                    <a href="{{ route('app.budgets.show', currentBudget()) }}" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                        @svg('cog', 'w-5 h-5 mr-2.5') Settings
                    </a>
    
                    <a href="#" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                        @svg('userplus', 'w-5 h-5 mr-2.5') Invite a friend
                    </a>
                            
                </div>
    
                <p class="px-2.5 pt-2 pb-1 text-sm text-gray-500">
                    Switch to a recent budget
                </p>
    
                <div class="px-2">
                    
                    @foreach (auth()->user()->joinedBudgets->take(3) as $budget)
                        <form action="{{ route('app.budgets.current', $budget) }}" method="post">

                            @csrf

                            <button type="submit" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 truncate focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed w-full" x-on:mouseenter="$focus.focus($el)">
                                {{ $budget->name }}
                            </button>
                        </form>
                    @endforeach
    
                </div>
    
                <div class="p-2 mt-1.5 border-t border-gray-200">
    
                    <a href="{{ route('app.budgets.create') }}" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                        @svg('pluscircle', 'w-5 h-5 mr-2.5') Create new budget
                    </a>
    
                </div>
    
            </nav>
    
        </div>

    </div>

    <!-- Main sidebar links -->
    <div class="flex-1 p-4 space-y-1 text-gray-600">

        <a href="{{ route('app.index') }}" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed {{ active('app.index', 'font-semibold text-gray-900') }}">
            @svg('home', 'w-5 h-5 mr-2.5') Home
        </a>

        <a href="#" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed  {{ active('app.calendar.*', 'font-semibold text-gray-900') }}">
            @svg('calendar', 'w-5 h-5 mr-2.5') Calendar
        </a>

        <a href="{{ route('app.incomes.index') }}" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed  {{ active('app.incomes.*', 'font-semibold text-gray-900') }}">
            @svg('banknotes', 'w-5 h-5 mr-2.5') Incomes
        </a>

        <a href="#" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed">
            @svg('creditcard', 'w-5 h-5 mr-2.5') Expenses
        </a>

        <a href="#" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed">
            @svg('bank', 'w-5 h-5 mr-2.5') Accounts
        </a>

        <a href="#" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed">
            @svg('pencilsquare', 'w-5 h-5 mr-2.5') Transactions
        </a>

        <a href="#" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed">
            @svg('files', 'w-5 h-5 mr-2.5') Files
        </a>
        
    </div>

    <!-- User profile menu -->  
    <div class="p-4">   

        <div x-data="{ open: false }" x-on:keydown.escape.window="open=false" class="relative">
            
            <button x-on:click="open=!open" class="flex items-center pl-2.5 pr-3 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed truncate max-w-full">
                @svg('profile', 'w-5 h-5 mr-2.5')
                {{ auth()->user()->display_name }}
            </button>

            <template x-teleport="body">
                <div x-cloak x-show="open" class="absolute inset-0 z-10 bg-gray-900/50"></div>
            </template>

            <div x-cloak x-show="open" x-trap="open" x-on:click.outside="open=false" class="absolute z-20 bottom-[110%] space-y-1 border border-gray-300 bg-white rounded-lg shadow-sm p-2 focus:outline-none" tabindex="-1">

                <a href="#" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                    @svg('cog', 'w-5 h-5 mr-2.5') Account settings
                </a>

                <a href="{{ route('app.budgets.index') }}" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                    @svg('stack', 'w-5 h-5 mr-2.5') Manage budgets
                </a>

                <form action="{{ route('logout') }}" method="post">
                    
                    @csrf

                    <button type="submit" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent  focus:border-gray-300 w-full focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                        @svg('logout', 'w-5 h-5 mr-2.5') Logout
                    </button>

                </form>

            </div>

        </div>


    </div>

</div>