@extends('app.budgets.show.layout')

@section('tab')
    <div class="p-6">

        <div class="prose prose-green">

            <h1>Delete Budget</h1>
    
            <p>Are you sure you want to delete this budget? This action cannot be undone.</p>
    
            <p>
                When you delete a budget, all of its data will be deleted. This includes all of it's incomes, expenses, accounts, transactions,and files.
            </p>

            <form action={{ route('app.budgets.destroy', $budget) }} method="post">

                @csrf
                @method('DELETE')
    
                <x-forms.buttons.primary type="submit">
                    Delete Budget
                </x-forms.buttons.primary>
                
            </form>
            
            <x-forms.validation-error for="budget" class="my-5" />
    
        </div>
        
    </div>
@endsection