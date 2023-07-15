@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('app.budgets.index'))
@section('page::title', 'Create Budget')

@section('content')

    <div class="max-w-xl p-4 mx-auto mb-8">
        
        <form action="{{ route('app.budgets.store') }}" method="post" class="space-y-4">

            @csrf

            <div class="space-y-2">
                <x-forms.label for="name" required>
                    What should we call this budget?
                </x-forms.label>
        
                <x-forms.input type="text" name="name" id="name" autofocus />
                
                <x-forms.validation-error for="name" />
            </div>
            
            <div class="flex items-center justify-end">  
                <button type="submit" class="px-5 font-semibold inline-block py-2.5 bg-green-600 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 border border-green-700 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-green-700 focus:outline-none focus:shadow text-green-50/100 shadow-sm hover:shadow-md hover:text-green-50 active:shadow-inner text-center select-none">
                    Create Budget
                </button>
            </div>
            
        </form>

    </div>
    
@endsection