@extends('layouts.app')

@section('page::title', 'Error 404')

@section('content')

    <div class="max-w-5xl mx-auto px-4 my-10 prose prose-xl prose-green">
        
        <h1>
            Whoops! We couldn't find that page.
        </h1>

        <p>
            The page you are looking for could not be found. Here are some helpful links to get you back on track:
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