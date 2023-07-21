<x-livewire-component class="w-full">

    <h2 class="text-2xl font-semibold text-center select-none text-gray-800/70">Reset Your Password</h2>

    <form wire:submit="attempt" class="py-4 space-y-3">

        <div class="prose-sm prose select-none">
            <p>
                If you have forgotten your password, enter your email address below and we will send you a link to reset your password.
        </p>
        </div>

        @if(session()->has('status'))
            <div class="text-xs text-center text-green-800">
                <span>{{ session('status') }}</span>
            </div>
        @endif

        @error('status')
            <div class="text-xs text-center text-red-400">
                <span>{{ $message }}</span>
            </div>
        @enderror

        <div>
            <x-forms.label for="email" required class="block mb-1 text-gray-800">Email address</x-forms.label>
            <x-forms.input type="email" id="email" x-ref="email" wire:model="email" autofocus />
            <x-forms.validation-error for="email" />
        </div>

        <x-forms.buttons.primary class="w-full">
            Send Reset Link
        </x-forms.buttons.primary>
        
        <div class="my-5 prose text-center prose-green">
            <a href="{{ route('login') }}">Remembered your password, login?</a>
        </div>

    </form>

</x-livewire-component>