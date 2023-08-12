<form class="border border-gray-300 bg-white rounded my-8" wire:submit="attempt">

    <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
        <h2 class="font-semibold text-gray-700">Create Income</h2>
    </header>

    <main class="p-4">

        <div class="space-y-4">

            <div class="space-y-2">
                <x-forms.label for="name" required>
                    What should we call this income?
                </x-forms.label>
        
                <x-forms.input type="text" name="name" id="name" wire:model="name" autofocus />
                
                <x-forms.validation-error for="name" />
            </div>
        
            <div class="space-y-2">
                <x-forms.label for="subtype_id" required>
                    What type of income is this?
                </x-forms.label>
        
                <x-forms.select name="subtype_id" id="subtype_id" wire:model="subtype_id">
                    <option value="">Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </x-forms.select>
        
                <x-forms.validation-error for="subtype_id" />
            </div>
        
            <div class="space-y-2">
                <x-forms.label for="frequency" required>
                    How often do you recieve installments of this income?
                </x-forms.label>
        
                <x-forms.select name="frequency" id="frequency" wire:model="frequency">
                    <option value="">Select a frequency</option>
                    @foreach ($frequencies as $frequency)
                        <option value="{{ $frequency->value }}">{{ $frequency->value }}</option>
                    @endforeach
                </x-forms.select>
        
                <x-forms.validation-error for="frequency" />
            </div>
        
            @if($users->count() > 1) 
        
                <div class="space-y-2">
                    <x-forms.label for="user_ulid">
                        Who, in your budget, would you say this income is associated with?
                    </x-forms.label>
        
                    <x-forms.select name="user_ulid" id="user_ulid" wire:model="user_ulid">
                        <option value="">Select a user</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->ulid }}">{{ $user->name }}</option>
                        @endforeach
                    </x-forms.select>
        
                    <x-forms.validation-error for="user_ulid" />
                </div>
                
            @endif

        </div>

    </main>

    <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
        
        <x-forms.buttons.primary type="submit" wire:loading.attr="disabled">
            Create Income
        </x-forms.buttons.primary>

    </footer>

</form>