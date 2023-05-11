<x-livewire-component>
    
    <form wire:submit.prevent="attempt">

        @error('status')
            <div>
                <span>{{ $message }}</span>
            </div>
        @enderror

        <div>
            <x-forms.label for="name" required>Your name</x-forms.label>
            <input type="text" wire:model="name" id="name" />
            @error('name') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <x-forms.label for="email" required>Email address</x-forms.label>
            <input type="email" wire:model="email" id="email" />
            @error('email') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <x-forms.label for="password" required>Password</x-forms.label>
            <input type="password" wire:model="password" id="password" />
            @error('password') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <x-forms.label for="password_confirmation" required>
                Password confirmation
            </x-forms.label>
            <input type="password" wire:model="password_confirmation" id="password_confirmation" />
            @error('password_confirmation') <span>{{ $message }}</span> @enderror
        </div>

        <div>
            <button type="submit">Sign up</button>
        </div>

    </form>

</x-livewire-component>