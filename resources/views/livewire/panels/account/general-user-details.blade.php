<form class="border border-gray-300 bg-white rounded my-8" wire:submit="attempt">

    <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
        <h2 class="font-semibold text-gray-700">General Settings</h2>
    </header>

    <main  class="p-4">

        <div class="space-y-4">

            <div class="space-y-2">
                <x-forms.label for="name" required>
                    Your Name
                </x-forms.label>
        
                <x-forms.input type="text" name="name" id="name" wire:model="name" />
                
                <x-forms.validation-error for="name" />
            </div>

            <div class="space-y-2">
                <x-forms.label for="nickname" required>
                    Your Nickname
                </x-forms.label>
        
                <x-forms.input type="text" name="nickname" id="nickname" wire:model="nickname" />
                
                <x-forms.validation-error for="nickname" />
            </div>

        </div>

    </main>

    <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
        
        <x-forms.buttons.primary type="submit" wire:loading.attr="disabled">
            Save Changes
        </x-forms.buttons.primary>

    </footer>

</form>