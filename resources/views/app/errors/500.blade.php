@extends('layouts.app')

@section('page::title', 'Error 500')

@section('content')

    <div class="max-w-5xl mx-auto px-4 my-10 prose prose-green">
        
        <h1>
            Whoops! Something went wrong on our end.
        </h1>

        <p>
            Our servers are having a bad day. We're working on it, but in the meantime, you can try the following links:
        </p>

        <ul>
            @if(url()->previous() != url()->current())
                <li>
                    <x-link href="{{ url()->previous() }}">Return to Previous Page</x-link>
                </li>
            @endif
            <li>
                <x-link href="{{ route('app.index') }}">Return to Dashboard</x-link>
            </li>
            <li>
                <x-link href="{{ route('app.budgets.index') }}">Return to Budgets</x-link>
            </li>
        </ul>

    </div>
    
@endsection