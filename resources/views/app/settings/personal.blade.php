@extends('layouts.app')

@section('page::title', 'Account Settings')

@section('content')

    <x-navbar :links="[
        [
            'label' => 'General',
            'route' => route('app.settings.personal'),
            'active' => 'app.settings.personal'
        ],
        [
            'label' => 'Security',
            'route' => '#',
            'active' => 'app.settings.security'
        ],
        [
            'label' => 'Notifications',
            'route' => '#',
            'active' => 'app.settings.notifications'
        ],
    ]" />

    <div class="max-w-3xl mx-auto px-4 my-10">

        <section class="border border-gray-300 bg-white rounded my-8">

            <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
                <h2 class="font-semibold text-gray-700">General Settings</h2>
            </header>

            <form id="edit-form" action="#" method="post" class="p-4">
                
                @csrf
                @method('PUT')

                <div class="space-y-4">

                    <div class="space-y-2">
                        <x-forms.label for="name" required>
                            Your Name
                        </x-forms.label>
                
                        <x-forms.input type="text" name="name" id="name" value="{{ user()->name }}" />
                        
                        <x-forms.validation-error for="name" />
                    </div>
    
                    <div class="space-y-2">
                        <x-forms.label for="nickname" required>
                            Your Nickname
                        </x-forms.label>
                
                        <x-forms.input type="text" name="nickname" id="nickname" value="{{ user()->nickname }}" />
                        
                        <x-forms.validation-error for="nickname" />
                    </div>

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
    
    </div>

@endsection