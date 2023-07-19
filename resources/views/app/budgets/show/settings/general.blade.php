@extends('app.budgets.show.settings.layout')

@section('tab')

    <section class="border border-gray-300 bg-white rounded my-8">

        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
            <h2 class="font-semibold text-gray-700">General Settings</h2>
        </header>


        <form id="edit-form" action="{{ route('app.budgets.update', $budget) }}" method="post" class="p-4">
            
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <x-forms.label for="name" required>
                    Budget Name
                </x-forms.label>
        
                <x-forms.input type="text" name="name" id="name" value="{{ $budget->name }}" />
                
                <x-forms.validation-error for="name" />
            </div>

        </form>

        <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
            <x-forms.buttons.primary form="edit-form">
                Save Changes
            </x-forms.buttons.primary>
        </footer>

    </section>

    <section class="border border-gray-300 bg-white rounded my-8">

        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
            <h2 class="font-semibold text-gray-700">Delete Budget</h2>
        </header>

        <form id="delete-form" action={{ route('app.budgets.destroy', $budget) }} method="post" class="p-4">
            @csrf
            @method('DELETE')

            <p>
                Are you sure you want to delete this budget? This action cannot be undone. When you delete a budget, all of its data will be deleted. This includes all of it's incomes, expenses, accounts, transactions, and files.
            </p>

            <x-forms.validation-error for="budget" class="my-5" />

        </form>

        <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
            <x-forms.buttons.danger confirm="true" type="submit" form="delete-form">
                Delete Budget
            </x-forms.buttons.danger>
        </footer>

    </section>

@endsection