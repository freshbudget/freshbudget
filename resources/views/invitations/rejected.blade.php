@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl selection:bg-gray-300/70">
            Oops, invitation has already been rejected!
        </h2>

    </main>

    <section class="max-w-3xl px-4 mx-auto mt-20 prose prose-lg prose-green">
        
        <p>
            You have already rejected this invitation. If you have changed your mind, you will need to login to your account, and accept the invitation from the <a href="{{ route('app.index') }}">dashboard</a>.
        </p>

    </section>
    
@endsection