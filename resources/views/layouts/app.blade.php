@extends('layouts.livewire')

@push('body::classes', 'bg-white selection:bg-gray-300')

@section('page')

    <div class="flex h-screen overflow-hidden">

        <aside 
            x-on:keydown.ctrl.period.window="desktopSidebarExpanded = !desktopSidebarExpanded" 
            x-data="{ desktopSidebarExpanded: $persist({{ session('desktopSidebarExpanded', 'true') }}) }"
            x-init="$watch('desktopSidebarExpanded', value => window.syncUIState('desktopSidebarExpanded', value))">

            <!-- collapsed desktop sidebar -->
            <div 
                {{ session('desktopSidebarExpanded') ? 'x-cloak' : '' }}
                x-show="!desktopSidebarExpanded" 
                class="flex flex-shrink-0 w-16 h-full bg-white border-r border-gray-300">
                @include('layouts.partials.collapsed-desktop-sidebar')
            </div>

            <!-- expanded desktop sidebar -->
            <div 
                {{ session('desktopSidebarExpanded') ? '' : 'x-cloak' }}
                x-show="desktopSidebarExpanded" 
                class="flex flex-shrink-0 hidden w-12 h-full bg-white border-r border-gray-300 sm:block sm:w-72">
                @include('layouts.partials.expanded-desktop-sidebar')
            </div>

            <!-- mobile menu -->
            <div 
                x-cloak 
                class="block sm:hidden">
                @include('layouts.partials.mobile-sidebar')
            </div>

        </aside>
    
        <main class="flex-1 min-w-0 overflow-y-auto bg-gray-100">
            @yield('content')  
        </main>
        
    </div>

@endsection