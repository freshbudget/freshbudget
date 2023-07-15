@extends('layouts.livewire')

@push('body::classes', 'bg-white selection:bg-gray-300')

@section('body')

    <div class="flex flex-col h-screen overflow-hidden sm:flex-row">

        <aside 
            x-on:keydown.ctrl.period.window="desktopSidebarExpanded = !desktopSidebarExpanded" 
            x-data="{ desktopSidebarExpanded: $persist({{ session('desktopSidebarExpanded', 'true') }}) }"
            x-init="$watch('desktopSidebarExpanded', value => window.syncUIState('desktopSidebarExpanded', value))">

            <!-- collapsed desktop sidebar -->
            <div 
                {{ session('desktopSidebarExpanded', true) ? 'x-cloak' : '' }}
                x-show="!desktopSidebarExpanded" 
                class="flex-shrink-0 hidden w-16 h-full bg-white border-r border-gray-300 sm:flex">
                @include('layouts.partials.collapsed-desktop-sidebar')
            </div>

            <!-- expanded desktop sidebar -->
            <div 
                {{ session('desktopSidebarExpanded', true) ? '' : 'x-cloak' }}
                x-show="desktopSidebarExpanded" 
                class="flex-shrink-0 hidden w-12 h-full bg-white border-r border-gray-300 sm:flex sm:w-72">
                @include('layouts.partials.expanded-desktop-sidebar')
            </div>

            <!-- mobile menu -->
            <div 
                
                x-data="{ open: false }"
                class="block sm:hidden">

                <template x-teleport="body">
                    <div x-cloak x-show="open" class="absolute inset-0 z-10 bg-gray-900/70"></div>
                </template>

                <!-- Mobile page header and nav toggle -->
                <div class="flex items-center p-3 border-b border-gray-300">
                
                    <button type="button" x-on:click="open=true" class="flex items-center justify-center p-2 mr-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm select-none hover:bg-gradient-to-br hover:from-white hover:to-gray-100 focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow hover:shadow hover:text-gray-900 active:shadow-inner">
                        @svg('bars', 'w-5 h-5 text-gray-500')
                    </button>

                    @hasSection('mobile::page::title')
                        @yield('mobile::page::title')
                    @endif
                    
                </div>

                <div 
                    x-cloak 
                    x-show="open" 
                    x-trap.inert.noscroll="open"
                    x-on:click.outside="open=false"
                    x-on:keydown.escape.window="open=false"
                    class="border-r border-gray-300 z-50 fixed top-0 left-0 bottom-0 bg-white w-[70%]">
                    @include('layouts.partials.expanded-desktop-sidebar')
                </div>
            </div>

        </aside>
    
        <main class="flex-1 min-w-0 overflow-y-auto bg-gray-100">

            <!-- Page header -->
            <div class="sm:p-4 p-2.5 bg-white border-b border-gray-300 select-none">
                
                @hasSection ('breadcrumbs')
                    @yield('breadcrumbs')
                @endif
                
                @hasSection ('page::title')
                    <h1 class="text-xl font-bold sm:text-2xl">
                        @yield('page::title')
                    </h1>    
                @endif

            </div>   

            @yield('content')              
        </main>
        
    </div>

@endsection