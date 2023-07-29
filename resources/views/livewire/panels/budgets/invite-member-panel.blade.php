<form class="border border-gray-300 bg-white rounded my-8" wire:submit="attempt">

    <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none flex items-center justify-between">
        <h2 class="font-semibold text-gray-700">Invite Member</h2>

        <a href="#" title="Learn more about this" class="flex items-center justify-center">
            @svg('info', 'h-6 w-6 text-gray-500')
        </a>
    </header>

    <main class="p-4">

        <div class="flex space-x-3 text-sm">

            <div class="space-y-2 w-full">
                <x-forms.label for="name" required>
                    Name
                </x-forms.label>
        
                <x-forms.input type="text" name="name" id="name" wire:model="name" />
                
                <x-forms.validation-error for="name" />
            </div>
    
            <div class="space-y-2 w-full">
                <x-forms.label for="email" required>
                    Email
                </x-forms.label>
        
                <x-forms.input type="text" name="email" id="email" wire:model="email" />
                
                <x-forms.validation-error for="email" />
            </div>
    
            <div class="space-y-2 w-full">
                <x-forms.label for="role" required>
                    Role
                </x-forms.label>
        
                <x-forms.select name="role" id="role" wire:model="role">
                    <option value="member">Member</option>
                    <option value="admin">Admin</option>
                    <option value="persona">Persona</option>
                </x-forms.select>
                
                <x-forms.validation-error for="role" />
            </div>
    
            <x-forms.validation-error for="error" />
        </div>

    </main>

    <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
        
        <x-forms.buttons.primary type="submit" wire:loading.attr="disabled">
            Send Invite
        </x-forms.buttons.primary>

    </footer>

</form>