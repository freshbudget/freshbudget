@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl selection:bg-gray-300/70">
            Oops, invitation has already been accepted!
        </h2>

    </main>

    <section class="max-w-3xl px-4 mx-auto mt-20 prose prose-lg prose-green">
        
        <p>
            You have already accepted this invitation. You can view and collaborate on the budget by <a href="{{ route('login') }}">logging in</a> to your account.
        </p>

    </section>
    
@endsection