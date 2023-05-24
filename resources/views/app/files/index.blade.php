@extends('layouts.app')

@section('content')

    <section class="flex h-screen overflow-hidden">

        <x-file-explorer.resources-sidebar />
        
        <main class="w-full h-full overflow-auto">
           Cool stuff here
        </main>

    </section>
    
@endsection