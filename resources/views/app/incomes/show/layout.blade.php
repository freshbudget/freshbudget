@extends('layouts.app')

@section('page::title', $income->name)
@section('breadcrumbs', Breadcrumbs::render('app.incomes.index'))

@section('content')

    <div class="sticky top-0 w-full bg-white border-b border-gray-300 select-none">
{{--         
        <div class="flex items-center px-6 py-2.5 space-x-4 text-gray-700 select-none">

            <div class="flex items-center space-x-1.5">
                @svg('banknotes', 'w-4 h-4 text-gray-500') <p>
                    {{ $income->presenter()->estimatedNetPerPeriod() }}/{{ $income->frequency }}
                </p>
            </div>

            <div class="flex items-center space-x-1.5">
                @svg('info', 'w-5 h-5 text-gray-500') <p>{{ $income->type->name }}</p>
            </div>

            @if($income->url)
                <div class="flex items-center space-x-1.5">
                    @svg('link', 'w-4 h-4 text-gray-500') <a href="{{ $income->url }}" target="_blank" title="{{ $income->url }}">
                        Visit
                    </a>
                </div>
            @endif
            
        </div> --}}

        <nav class="flex w-full px-4 -mb-px space-x-3">

            @php
                $links = [
                    [
                        'label' => 'Overview',
                        'route' => route('app.incomes.show', $income),
                        'active' => 'app.incomes.show'
                    ],
                    [
                        'label' => 'Transactions',
                        'route' => '#',
                        'active' => 'app.incomes.transactions.*'
                    ],
                    [
                        'label' => 'Entitlements',
                        'route' => route('app.incomes.entitlements.show', $income),
                        'active' => 'app.incomes.entitlements.*'
                    ],
                    [
                        'label' => 'Taxes',
                        'route' => route('app.incomes.taxes.show', $income),
                        'active' => 'app.incomes.taxes.*'
                    ],
                    [
                        'label' => 'Deductions',
                        'route' => route('app.incomes.deductions.show', $income),
                        'active' => 'app.incomes.deductions.*'
                    ],
                    // [
                    //     'label' => 'Attachments',
                    //     'route' => '#',
                    //     'active' => 'app.incomes.attachments.*'
                    // ],
                    [
                        'label' => 'Edit',
                        'route' => route('app.incomes.edit', $income),
                        'active' => 'app.incomes.edit'
                    ],
                ]
            @endphp

            @foreach ($links as $link)
                <a href="{!! $link['route'] !!}" class="block px-1 text-sm py-3 border-b-2 {{ active($link['active'], 'font-semibold border-gray-400', 'border-transparent hover:border-gray-300') }}">
                    {!! $link['label'] !!}
                </a>                
            @endforeach

        </nav>

    </div>

    <div class="p-6">

        @yield('tab')

    </div>

@endsection