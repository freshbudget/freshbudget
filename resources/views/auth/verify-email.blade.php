@extends('layouts.app')

@section('content')

    @if (auth()->user()->email_verified_at)

        <h2>Your email is verified</h2>

        <p>
            Your good to go. You can now access all the features of the site.
        </p>
        
    @else


        <h2>Verify email before continuing</h2>

        <hr>

        @if (session('message'))
            <p>{{ session('message') }}</p>
        @endif

        <form action="{{ route('verification.send') }}" method="post">
            @csrf
            <button type="submit">Resend verification email</button>
        </form>

    @endif

    
@endsection