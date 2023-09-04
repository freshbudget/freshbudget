<form class="border border-gray-300 bg-white rounded my-8" wire:submit="attempt">

    <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
        <h2 class="font-semibold text-gray-700">Create Expense</h2>
    </header>

    <main class="p-4">

        <div class="space-y-4">

            <div class="space-y-2">
                <x-forms.label for="name" required>
                    What should we call this expense?
                </x-forms.label>
        
                <x-forms.input type="text" name="name" id="name" wire:model="name" autofocus />
                
                <x-forms.validation-error for="name" />
            </div>
        
            <div class="space-y-2">
                <x-forms.label for="subtype_id" required>
                    What type of expense is this?
                </x-forms.label>
        
                <x-forms.select name="subtype_id" id="subtype_id" wire:model="subtype_id">
                    <option value="">Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </x-forms.select>
        
                <x-forms.validation-error for="subtype_id" />
            </div>

        </div>

    </main>

    <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
        
        <x-forms.buttons.primary type="submit" wire:loading.attr="disabled">
            Create Expense
        </x-forms.buttons.primary>

    </footer>

</form>