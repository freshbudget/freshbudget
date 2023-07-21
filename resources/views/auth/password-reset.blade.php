<x-livewire-component class="w-full">

    <h2 class="text-2xl font-semibold text-center select-none text-gray-800/70">Reset Your Password</h2>

    <form wire:submit="attempt" class="py-4 space-y-5">

        @error('status')
            <div class="text-xs text-center text-red-400">
                <span>{{ $message }}</span>
            </div>
        @enderror

        <div>
            <x-forms.label for="email" required class="block mb-1 text-gray-800">
                Email Address
            </x-forms.label>

            <x-forms.input type="email" id="email" wire:model="email" readonly />
            
            <x-forms.validation-error for="email" />
        </div>

        <div>
            <x-forms.label for="password" required class="block mb-1 text-gray-800">
                Enter your new password
            </x-forms.label>

            <x-forms.input type="password" id="password" wire:model="password" autofocus />
            
            <x-forms.validation-error for="password" />
        </div>

        <x-forms.buttons.primary class="w-full">
            Reset Password and Login
        </x-forms.buttons.primary>

    </form>

</x-livewire-component>