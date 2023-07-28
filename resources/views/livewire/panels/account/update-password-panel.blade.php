<form class="border border-gray-300 bg-white rounded my-8" wire:submit="attempt">

    <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
        <h2 class="font-semibold text-gray-700">Change Password</h2>
    </header>

    <main  class="p-4">

        <div class="space-y-4">

            <div class="space-y-2">
                <x-forms.label for="current_password" required>
                    Your Current Password
                </x-forms.label>
        
                <x-forms.input type="password" name="current_password" id="current_password" wire:model="current_password" />
                
                <x-forms.validation-error for="current_password" />
            </div>

            <div class="space-y-2">
                <x-forms.label for="password" required>
                    New Password
                </x-forms.label>
        
                <x-forms.input type="password" name="password" id="password" wire:model="password" />
                
                <x-forms.validation-error for="password" />
            </div>

            <div class="space-y-2">
                <x-forms.label for="password_confirmation" required>
                    Password Confirmation
                </x-forms.label>
        
                <x-forms.input type="password" name="password_confirmation" id="password_confirmation" wire:model="password_confirmation" />
                
                <x-forms.validation-error for="password_confirmation" />
            </div>

        </div>

    </main>

    <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
        
        <x-forms.buttons.primary type="submit" wire:loading.attr="disabled">
            Update Password
        </x-forms.buttons.primary>

    </footer>

</form>