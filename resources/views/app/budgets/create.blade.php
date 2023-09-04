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
                <x-forms.buttons.primary type="submit">
                    Create Budget
                </x-forms.buttons.primary>
            </div>
            
        </form>

    </div>
    
@endsection