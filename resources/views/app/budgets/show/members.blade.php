@extends('app.budgets.show.layout')

@section('tab')

    <section class="border border-gray-300 bg-white rounded my-8">

        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
            <h2 class="font-semibold text-gray-700">Invite Member</h2>
        </header>


        <form id="invite-form" action="{{ route('app.budgets.members.store', $budget) }}" method="post" class="p-4">

            @csrf
            
            <div class="flex space-x-3 text-sm">

                <div class="space-y-2 w-full">
                    <x-forms.label for="name" required>
                        Name
                    </x-forms.label>
            
                    <x-forms.input type="text" name="name" id="name" />
                    
                    <x-forms.validation-error for="name" />
                </div>
    
                <div class="space-y-2 w-full">
                    <x-forms.label for="email" required>
                        Email
                    </x-forms.label>
            
                    <x-forms.input type="text" name="email" id="email" />
                    
                    <x-forms.validation-error for="email" />
                </div>

                <div class="space-y-2 w-full">
                    <x-forms.label for="role">
                        Role
                    </x-forms.label>
            
                    <x-forms.select name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="member">Member</option>
                    </x-forms.select>
                    
                    <x-forms.validation-error for="role" />
                </div>

                <x-forms.validation-error for="error" />
            </div>

        </form>

        <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
            <x-forms.buttons.primary form="invite-form">
                Send Invite
            </x-forms.buttons.primary>
        </footer>

    </section>
    
@endsection