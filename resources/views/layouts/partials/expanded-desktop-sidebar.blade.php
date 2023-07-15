<div class="flex flex-col w-full h-full select-none">

    <!-- Budget selector -->
    <div class="p-4">

        <div x-data="{ open: false }" x-on:keydown.escape.stop.window="open=false" class="relative">
    
            <button x-on:click="open = !open" type="button" class="px-2.5 font-semibold py-2 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner w-full flex items-center justify-between">
    
                <span class="truncate">{{ user()->currentBudget->name }}</span>  
    
                <span class="flex items-center justify-center w-5 h-5">@svg('chevron-down', 'w-full h-full text-gray-500')</span>
                
            </button>
    
            <template x-teleport="body">
                <div x-cloak x-show="open" class="absolute inset-0 z-10 bg-gray-900/50"></div>
            </template>
    
            <nav x-cloak x-show="open" x-trap="open" x-on:click.outside="open=false" class="absolute left-0 z-50 w-full bg-white rounded-lg shadow-lg top-12 focus:outline-none" tabindex="-1">
    
                <p class="px-2.5 pt-2 pb-1 text-sm text-gray-500 truncate">
                    {{ user()->currentBudget->name }}
                </p>
    
                <div class="px-2">
    
                    <a href="{{ route('app.budgets.show', currentBudget()) }}" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                        @svg('cog', 'w-5 h-5 mr-2.5') Settings
                    </a>
    
                    <a href="#" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                        @svg('userplus', 'w-5 h-5 mr-2.5') Invite a friend
                    </a>
                            
                </div>

                @if(user()->joinedBudgets->count() > 1)
    
                    <p class="px-2.5 pt-2 pb-1 text-sm text-gray-500">
                        Switch to a recent budget
                    </p>
        
                    <div class="px-2">
                        
                        @foreach (user()->joinedBudgets->take(3) as $budget)
                            <form action="{{ route('app.budgets.current', $budget) }}" method="post">

                                @csrf

                                <button type="submit" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 truncate focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed w-full" x-on:mouseenter="$focus.focus($el)">
                                    {{ $budget->name }}
                                </button>
                            </form>
                        @endforeach
        
                    </div>

                @endif
    
                <div class="p-2 mt-1.5 border-t border-gray-200">
    
                    <a href="{{ route('app.budgets.create') }}" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                        @svg('pluscircle', 'w-5 h-5 mr-2.5') Create new budget
                    </a>
    
                </div>
    
            </nav>
    
        </div>

    </div>

    <!-- Main sidebar links -->
    <div class="flex-1 p-4 space-y-1 text-gray-600" x-data="{}">

        @php
            $links = [
                [
                    'label' => 'Home',
                    'route' => route('app.index'),
                    'icon' => 'home',
                    'active' => 'app.index'
                ],
                [
                    'label' => 'Calendar',
                    'route' => '#',
                    'icon' => 'calendar',
                    'active' => 'app.calendar.*'
                ],
                [
                    'label' => 'Incomes',
                    'route' => route('app.incomes.index'),
                    'icon' => 'banknotes',
                    'active' => 'app.incomes.*'
                ],
                [
                    'label' => 'Expenses',
                    'route' => "#",
                    'icon' => 'creditcard',
                    'active' => 'app.expenses.*'
                ],
                [
                    'label' => 'Accounts',
                    'route' => "#",
                    'icon' => 'bank',
                    'active' => 'app.accounts.*'
                ],
                [
                    'label' => 'Transactions',
                    'route' => "#",
                    'icon' => 'pencilsquare',
                    'active' => 'app.transactions.*'
                ],
                [
                    'label' => 'Files',
                    'route' => route('app.files.index'),
                    'icon' => 'files',
                    'active' => 'app.files.*'
                ],
                [
                    'label' => 'Budgets',
                    'route' => route('app.budgets.index'),
                    'icon' => 'stack',
                    'active' => 'app.budgets.*'
                ],
            ]
        @endphp

        @foreach ($links as $link)
            
            <a 
                href="{{ $link['route'] }}" 
                x-on:mouseleave="$el.blur()"
                x-on:mouseenter="$focus.focus($el)" 
                class="flex items-center justify-normal px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed {{ active($link['active'], 'font-semibold text-gray-900') }}">

                <div class="flex items-center">
                    @svg($link['icon'], 'w-5 h-5 mr-2.5')
                </div>

                <p class="block">
                    {{ $link['label'] }}
                </p>
                
            </a>

        @endforeach

    </div>

    <!-- User profile menu -->  
    <div class="flex items-center justify-between p-4">   

        <div x-data="{ open: false }" x-on:keydown.escape.window.stop="open=false" class="relative">
            
            <button x-on:click="open=!open" class="flex items-center pl-2.5 pr-3 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed truncate max-w-full">
                @svg('profile', 'w-5 h-5 mr-2.5')
                {{ user()->display_name }}
            </button>

            <template x-teleport="body">
                <div x-cloak x-show="open" class="absolute inset-0 z-10 bg-gray-900/70"></div>
            </template>

            <div x-cloak x-show="open" x-trap="open" x-on:click.outside="open=false" class="absolute z-20 bottom-[110%] space-y-1 border border-gray-300 bg-white rounded-lg shadow-sm p-2 focus:outline-none" tabindex="-1">

                <a href="{{ route('app.settings.personal') }}" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
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

        <button x-on:click="desktopSidebarExpanded=false" class="items-center pl-2.5 pr-3 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed truncate max-w-full sm:flex hidden" title="Collapse sidebar (Ctrl+.)">
            @svg('sidebar', 'w-5 h-5')
        </button>

    </div>

</div>