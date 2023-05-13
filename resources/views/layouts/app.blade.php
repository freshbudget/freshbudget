@extends('layouts.livewire')

@section('page')

    <div class="flex w-full h-screen">

        <aside class="fixed top-0 bottom-0 left-0 bg-white border-r border-gray-300 w-72">
            
            @include('layouts.partials.sidebar-content')

        </aside>

        <main class="flex-1 bg-gray-100 h-[5000px]">
            
        </main>
        
    </div>

    {{-- <h1>App Layout</h1>

    <p>Your logged in as {{ auth()->user()->name }} ({{ auth()->user()->email }})</p>

    <form action="{{ route('logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form> --}}    

@endsection