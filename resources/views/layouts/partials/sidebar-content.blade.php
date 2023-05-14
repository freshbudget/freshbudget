<div class="flex flex-col w-full h-full select-none">

    <!-- Budget selector -->
    <div x-data="{ open: false }" x-on:keydown.escape.window="open=false" class="relative p-4">

        <button x-on:click="open = !open" type="button" class="px-2.5 font-semibold py-2 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner w-full flex items-center justify-between">

            {{ auth()->user()->currentBudget->name }}  

            <span class="flex items-center justify-center w-5 h-5">@svg('chevron-down', 'w-full h-full text-gray-500')</span>
            
        </button>

        <nav x-cloak x-show="open" x-trap="open" x-on:click.outside="open=false" class="absolute left-0 z-50 m-4 bg-white border border-gray-300 rounded-lg shadow w-72 top-12" tabindex="-1">

            <p class="px-2.5 pt-2 pb-1 text-sm text-gray-500">
                {{ auth()->user()->currentBudget->name }}
            </p>

            <div class="px-2">

                <a href="#" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)" x-on:mouseout="">
                    @svg('cog', 'w-5 h-5 mr-2.5') Settings
                </a>

                <a href="#" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)" x-on:mouseout="">
                    @svg('userplus', 'w-5 h-5 mr-2.5') Invite a friend
                </a>
                        
            </div>

            <p class="px-2.5 pt-2 pb-1 text-sm text-gray-500">
                Switch Budgets
            </p>

            <div class="px-2">
                
                @foreach (auth()->user()->joinedBudgets as $budget)
                    <a href="#" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)" x-on:mouseout="">
                        {{ $budget->name }}
                    </a>
                @endforeach

            </div>

            <div class="py-1.5 px-2 mt-1.5 border-t border-gray-200">

                <a href="#" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)" x-on:mouseout="">
                    @svg('pluscircle', 'w-5 h-5 mr-2.5') Create new budget
                </a>

            </div>

        </nav>

    </div>

    <!-- Main links -->
    <div class="flex-1 p-4 space-y-1 text-gray-600">

        <a href="{{ route('app.index') }}" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed {{ active('app.index', 'font-semibold text-gray-900') }}">
            @svg('home', 'w-5 h-5 mr-2.5') Home
        </a>

        <a href="{{ route('app.incomes.index') }}" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed  {{ active('app.incomes.*', 'font-semibold text-gray-900') }}">
            @svg('banknotes', 'w-5 h-5 mr-2.5') Incomes
        </a>

        <a href="#" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed">
            @svg('creditcard', 'w-5 h-5 mr-2.5') Expenses
        </a>

        <a href="#" class="flex items-center px-2.5 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed">
            @svg('box', 'w-5 h-5 mr-2.5') Accounts
        </a>
        
    </div>

    <!-- User profile -->  
    <div class="p-4">   

        <div x-data="{ open: false }" class="relative">

            <button x-on:click="open=!open" class="flex items-center pl-2.5 pr-3 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed">
                @svg('profile', 'w-5 h-5 mr-2.5')
                {{ auth()->user()->display_name }}
            </button>

            <div x-cloak x-show="open" x-trap="open" x-on:click.outside="open=false" x-on:keydown.escape.window="open=false" class="absolute bottom-[110%] space-y-1 w-full border border-gray-300 bg-white rounded-lg shadow-sm p-2 focus:outline-none" tabindex="-1">

                <a href="#" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)" x-on:mouseout="">
                    @svg('cog', 'w-5 h-5 mr-2.5') Account settings
                </a>

                <form action="{{ route('logout') }}" method="post">
                    
                    @csrf

                    <button type="submit" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent  focus:border-gray-300 w-full focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)" x-on:mouseout="">
                        @svg('logout', 'w-5 h-5 mr-2.5') Logout
                    </button>

                </form>

            </div>

        </div>


    </div>

</div>