@extends('layouts.app')

@section('content')

    <section class="flex h-screen overflow-hidden">

        <x-income-sidebar />
        
        <main class="w-full h-full overflow-auto">
           @yield('section')  
        </main>

    </section>
    
@endsection