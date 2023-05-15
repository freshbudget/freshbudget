@extends('app.budgets.show.layout')

@section('tab')
    <div class="px-6 py-3 space-y-3">

        <div class="flex items-center justify-end">

            <a href="{{ route('app.budgets.create') }}" class="flex items-center justify-center p-2.5 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm select-none hover:bg-gradient-to-br hover:from-white hover:to-gray-100 focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow hover:shadow hover:text-gray-900 active:shadow-inner" title="Create budget">
                @svg('plus', 'w-5 h-5 text-gray-500 mr-2') Invite new member
            </a>

        </div>
        
        @livewire('tables.budgets.members-table')        

    </div>
@endsection