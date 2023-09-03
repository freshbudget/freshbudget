<div class="flex flex-col w-full h-full select-none">

    <!-- Budget selector -->
    @if(user()->joinedBudgets->count() > 1)
        <div class="p-4">

            <div x-data="{ open: false }" x-on:keydown.escape.stop.window="open=false" class="relative">
        
                <button x-on:click="open = !open" type="button" class="px-2.5 font-semibold py-2 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner w-full flex items-center justify-between">
        
                    <span class="truncate">{{ currentBudget()->name }}</span>  
        
                    <span class="flex items-center justify-center w-5 h-5">@svg('chevron-down', 'w-full h-full text-gray-500')</span>
                    
                </button>
        
                <template x-teleport="body">
                    <div x-cloak x-show="open" class="absolute inset-0 z-10 bg-gray-900/50"></div>
                </template>
        
                <nav x-cloak x-show="open" x-trap="open" x-on:click.outside="open=false" class="absolute left-0 z-50 w-full text-sm bg-white rounded-lg shadow-lg top-12 focus:outline-none" tabindex="-1">
        
                    <p class="px-2.5 pt-2 pb-1 text-sm text-gray-500 truncate">
                        {{ currentBudget()->name }}
                    </p>
        
                    <div class="px-2">
        
                        <x-link href="{{ route('app.budgets.show', currentBudget()) }}" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                            @svg('cog', 'w-5 h-5 mr-2.5') Settings
                        </x-link>
        
                        <x-link href="{{ route('app.budgets.members.index', currentBudget()) }}" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                            @svg('userplus', 'w-5 h-5 mr-2.5') Invite a member
                        </x-link>
                                
                    </div>

                    @if(user()->joinedBudgets->count() > 1)
        
                        <p class="px-2.5 pt-2 pb-1 text-sm text-gray-500">
                            Switch to a recent budget
                        </p>
            
                        <div class="px-2 pb-2">
                            
                            @foreach (user()->joinedBudgets->take(1) as $budget)
                                <form action="{{ route('app.budgets.current', $budget) }}" method="post">

                                    @csrf

                                    <button type="submit" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 truncate focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed w-full" x-on:mouseenter="$focus.focus($el)">
                                        {{ $budget->name }}
                                    </button>
                                </form>
                            @endforeach
            
                        </div>

                    @endif
        
                </nav>
        
            </div>

        </div>
    @endif

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
                    'route' => route('app.calendar.index'),
                    'icon' => 'calendar',
                    'active' => 'app.calendar.*'
                ],
                [
                    'label' => 'Accounts',
                    'route' => route('app.accounts.index'),
                    'icon' => 'bank',
                    'active' => 'app.accounts.*'
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
                    'label' => 'Transactions',
                    'route' => route('app.transactions.create'),
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
            

            <x-link 
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
                
            </x-link>

        @endforeach

    </div>

    <!-- User profile menu -->  
    <div class="flex items-center justify-between p-4">   

        <div x-data="{ open: false }" x-on:keydown.escape.window.stop="open=false" class="relative">
            
            <button x-on:click="open=!open" class="flex items-center pl-2.5 pr-3 py-1.5 hover:bg-gray-100/90 relative focus:outline-none hover:shadow-sm hover:border-gray-300 border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed">
                
                @svg('profile', 'w-5 h-5 mr-2.5')
                
                <span 
                    class="max-w-[7rem] truncate" 
                    x-on:user-display-name-updated.window="$el.innerText=$event.detail.name">
                    {{ user()->display_name }}
                </span>

            </button>

            <template x-teleport="body">
                <div x-cloak x-show="open" class="absolute inset-0 z-10 bg-gray-900/70"></div>
            </template>

            <div x-cloak x-show="open" x-trap="open" x-on:click.outside="open=false" class="absolute z-20 bottom-[110%] space-y-1 border border-gray-300 bg-white rounded-lg shadow-sm p-2 focus:outline-none w-64" tabindex="-1">

                <x-link href="{{ route('app.settings.personal') }}" class="flex items-center px-2.5 py-1.5 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed" x-on:mouseenter="$focus.focus($el)">
                    @svg('cog', 'w-5 h-5 mr-2.5') Account settings
                </x-link>

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