@extends('layouts.livewire')

@push('body::classes', 'bg-white selection:bg-gray-300')

@section('page')

    <div class="flex h-screen overflow-hidden">

        <aside class="flex flex-shrink-0 h-full bg-white border-r border-gray-300 w-72">
            @include('layouts.partials.sidebar-content')
        </aside>
    
        <main class="flex-1 min-w-0 overflow-y-auto bg-gray-100">
            @yield('content')  
        </main>
        
    </div>

@endsection