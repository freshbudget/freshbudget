<x-livewire-component>
    
    <form wire:submit.prevent="attempt">

        @error('status')
            <div>
                <span>{{ $message }}</span>
            </div>
        @enderror

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
            <label for="remember">Remember me</label>
            <input type="checkbox" wire:model="remember" id="remember" />
        </div>

        <div>
            <button type="submit">Sign in</button>
        </div>

    </form>

</x-livewire-component>