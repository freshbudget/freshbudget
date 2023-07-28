@extends('app.settings.layout')

@section('page::title', 'Account Settings')

@section('tab')

    @livewire('panels.account.general-user-details')

    <section class="border border-gray-300 bg-white rounded my-8">

        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
            <h2 class="font-semibold text-gray-700">Delete Your Account</h2>
        </header>

        <form id="delete-form" action="#" method="post" class="p-4 select-none">
            @csrf
            @method('DELETE')

            <p>
                Are you sure you want to delete your account? This action cannot be undone. When you delete your account, all of your data will be deleted. This includes all of your incomes, expenses, accounts, transactions, files, etc.
            </p>

            <x-forms.validation-error for="account" class="my-5" />

        </form>

        <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
            <x-forms.buttons.danger confirm="true" type="submit" form="delete-form">
                Delete Account
            </x-forms.buttons.danger>
        </footer>

    </section>
    
@endsection