@extends('layouts.app')

@section('page::title', 'Dashboard')

@push('body::end')
    @vite(['resources/js/highcharts.js'])
@endpush
@section('content')

    @if (user()->finished_onboarding)
        <div class="sticky top-0">

            <x-navbar :links="[
                [
                    'label' => 'Feed',
                    'route' => route('app.index'),
                    'active' => 'app.index'
                ],
                [
                    'label' => 'Charts &amp; Graphs',
                    'route' => '#',
                    'active' => 'app.index2'
                ],
                [
                    'label' => 'Custom',
                    'route' => '#',
                    'active' => 'app.index2',
                ]
            ]" />

        </div>

        <div class="max-w-3xl px-4 mx-auto">
            <x-chart />
        </div>

    @else

        <div class="max-w-2xl mx-auto px-4 prose prose-green my-8">

            <h2>Hello {{ user()->name }} 👋</h2>

            <p>
                Thank you for giving us a try. We are excited to have you here. Here is a quick list of items you might want to setup to get started.
            </p>

            <ul>
                <li>
                    @if(currentBudget()->incomes->count() < 1)
                        <h3>Add an Income Source</h3>
                        <p>
                            We can help you track your income, you can add your first income source by clicking <a href="{{ route('app.incomes.create') }}">here</a>.
                        </p>
                    @else
                        <h3>✅ Add an Income Source</h3>
                    @endif
                </li>
                <li>
                    @if(currentBudget()->members->count() < 2)
                        <h3>Invite someone to help manage your budget</h3>
                        <p>
                            You can invite someone to help manage your budget by clicking <a href="{{ route('app.budgets.members.index', currentBudget()) }}">here</a>.
                        </p>
                    @endif
                </li>
            </ul>

        </div>

    @endif

@endsection