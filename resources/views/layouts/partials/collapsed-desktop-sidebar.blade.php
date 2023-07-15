<div class="flex flex-col w-full h-full select-none">

    <!-- Main sidebar links -->
    <div class="flex flex-col items-center flex-1 py-3 space-y-1 text-gray-600" x-data="{}">

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

        @foreach($links as $link)

            <a 
                href="{{ $link['route'] }}" 
                title="{{ $link['label'] }}"
                class="flex items-center justify-center w-10 h-10 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed {{ active($link['active'], 'font-semibold text-gray-900') }}" 
                x-on:mouseenter="$focus.focus($el)" 
                x-on:mouseleave="$el.blur()">
                @svg($link['icon'], 'w-5 h-5')
            </a>

        @endforeach

    </div>

    <!-- User profile menu -->  
    <div class="flex flex-col items-center justify-center pb-2 space-y-1">   

        <a href="#" class="flex items-center justify-center w-10 h-10 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed {{ active('app.index', 'font-semibold text-gray-900') }}" x-on:mouseenter="$focus.focus($el)" x-on:mouseleave="$el.blur()" title="Switch Budgets">
            @svg('arrows-left-right', 'w-5 h-5')
        </a>

        <a href="{{ route('app.settings.personal') }}" class="relative flex items-center w-10 h-10 max-w-full p-2 leading-relaxed tracking-tight truncate border border-transparent rounded-lg hover:bg-gray-100/90 focus:outline-none hover:shadow-sm hover:border-gray-300 focus:border-gray-300 focus:bg-gray-100" title="View account settings">
            @svg('profile', 'w-5 h-5')
        </a>

        <button x-on:click="desktopSidebarExpanded=true" class="relative flex items-center w-10 h-10 max-w-full p-2 leading-relaxed tracking-tight truncate border border-transparent rounded-lg hover:bg-gray-100/90 focus:outline-none hover:shadow-sm hover:border-gray-300 focus:border-gray-300 focus:bg-gray-100" title="Expand sidebar (Ctrl+.)">
            @svg('sidebar', 'w-5 h-5')
        </button>
        
    </div>

</div>