@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl selection:bg-gray-300/70">
            Oops, invitation not found!
        </h2>

    </main>

    <section class="max-w-3xl px-4 mx-auto mt-20 prose prose-lg prose-green">
        
        <p>
            We couldn't find the invitation you were looking for, it is possible that the invitation has been canceled.
        </p>

        <p class="mt-4">
            If you think this is a mistake, please contact the person who sent you the invitation. While you're here, why not check out our <a href="{{ route('welcome') }}">home page</a>?
        </p>

    </section>
    
@endsection