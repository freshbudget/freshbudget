<form class="border border-gray-300 bg-white rounded my-8" wire:submit="attempt">

    <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
        <h2 class="font-semibold text-gray-700">Create Account</h2>
    </header>

    <main class="p-4">

        <div class="space-y-4">

            <div class="space-y-2">
                <x-forms.label for="name" required>
                    What should we call this account?
                </x-forms.label>
        
                <x-forms.input type="text" name="name" id="name" wire:model="name" autofocus />
                
                <x-forms.validation-error for="name" />
            </div>
        
            <div class="space-y-2">
                <x-forms.label for="subtype_id" required>
                    What type of account is this?
                </x-forms.label>
        
                <x-forms.select name="subtype_id" id="subtype_id" wire:model.live="subtype_id">
                    <option value="">Select a type</option>
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </x-forms.select>
        
                <x-forms.validation-error for="subtype_id" />
            </div>

            @if($subtype_id != null && $subtype_id != \App\Models\AssetAccountType::where('name', 'Cash')->first()->id)
            
                <div class="space-y-2">
                    <x-forms.label for="institution_id">
                        What institution is this account associated with?
                    </x-forms.label>
            
                    <x-forms.select name="institution_id" id="institution_id" wire:model.live="institution_id">
                        @foreach ($institutes as $institute)
                            <option value="{{ $institute->id }}">{{ $institute->name }}</option>                            
                        @endforeach
                        <option value="0">
                            Other
                        </option>
                    </x-forms.select>
            
                    <x-forms.validation-error for="institution_id" />
                </div>    

                @if($institution_id == 0 && $institution_id != null)
            
                    <div class="space-y-2">
                        <x-forms.label for="institution_name">
                            What is the name of the institution?
                        </x-forms.label>
                
                        <x-forms.input type="text" name="institution_name" id="institution_name" wire:model="institution_name" />
                
                        <x-forms.validation-error for="institution_name" />
                    </div>
                    
                @endif
            
                <div class="space-y-2">
                    <x-forms.label for="url">
                        Where can you access this account online?
                    </x-forms.label>
            
                    <x-forms.input type="url" name="url" id="url" wire:model="url" />
            
                    <x-forms.validation-error for="url" />
                </div>           

            @endif

            @if($users->count() > 1) 
        
                <div class="space-y-2">
                    <x-forms.label for="user_ulid">
                        Who, in your budget, would you say this account is associated with?
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
            Create Account
        </x-forms.buttons.primary>

    </footer>

</form>