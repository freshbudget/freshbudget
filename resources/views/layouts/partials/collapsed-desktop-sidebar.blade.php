<div class="flex flex-col w-full h-full select-none">

    <!-- Main sidebar links -->
    <div class="flex flex-col items-center flex-1 py-3 space-y-1 text-gray-600" x-data="{}">

        <a href="{{ route('app.index') }}" class="flex items-center justify-center w-10 h-10 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed {{ active('app.index', 'font-semibold text-gray-900') }}" x-on:mouseenter="$focus.focus($el)" x-on:mouseleave="$el.blur()">
            @svg('home', 'w-5 h-5')
        </a>

        <a href="#" class="flex w-10 h-10 justify-center p-2 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed  {{ active('app.calendar.*', 'font-semibold text-gray-900') }}" x-on:mouseenter="$focus.focus($el)" x-on:mouseleave="$el.blur()">
            @svg('calendar', 'w-5 h-5')
        </a>

        <a href="{{ route('app.incomes.index') }}" class="flex items-center w-10 h-10 justify-center p-2 relative focus:outline-none border border-transparent focus:border-gray-300 focus:bg-gray-100 rounded-lg tracking-tight leading-relaxed  {{ active('app.incomes.*', 'font-semibold text-gray-900') }}" x-on:mouseenter="$focus.focus($el)" x-on:mouseleave="$el.blur()">
            @svg('banknotes', 'w-5 h-5')
        </a>

        <a href="#" class="relative flex items-center justify-center w-10 h-10 p-2 leading-relaxed tracking-tight border border-transparent rounded-lg focus:outline-none focus:border-gray-300 focus:bg-gray-100" x-on:mouseenter="$focus.focus($el)" x-on:mouseleave="$el.blur()">
            @svg('creditcard', 'w-5 h-5')
        </a>

        <a href="#" class="relative flex items-center justify-center w-10 h-10 p-2 leading-relaxed tracking-tight border border-transparent rounded-lg focus:outline-none focus:border-gray-300 focus:bg-gray-100" x-on:mouseenter="$focus.focus($el)" x-on:mouseleave="$el.blur()">
            @svg('bank', 'w-5 h-5')
        </a>

        <a href="#" class="relative flex items-center justify-center w-10 h-10 p-2 leading-relaxed tracking-tight border border-transparent rounded-lg focus:outline-none focus:border-gray-300 focus:bg-gray-100" x-on:mouseenter="$focus.focus($el)" x-on:mouseleave="$el.blur()">
            @svg('pencilsquare', 'w-5 h-5')
        </a>

    </div>

    <!-- User profile menu -->  
    <div class="flex flex-col items-center justify-center pb-2 space-y-1">   

        <a href="#" class="relative flex items-center w-10 h-10 max-w-full p-2 leading-relaxed tracking-tight truncate border border-transparent rounded-lg hover:bg-gray-100/90 focus:outline-none hover:shadow-sm hover:border-gray-300 focus:border-gray-300 focus:bg-gray-100">
            @svg('profile', 'w-5 h-5')
        </a>

        <button x-on:click="desktopSidebarExpanded=true" class="relative flex items-center w-10 h-10 max-w-full p-2 leading-relaxed tracking-tight truncate border border-transparent rounded-lg hover:bg-gray-100/90 focus:outline-none hover:shadow-sm hover:border-gray-300 focus:border-gray-300 focus:bg-gray-100">
            @svg('chevron-double-right', 'w-5 h-5')
        </button>
        
    </div>

</div>