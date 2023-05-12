<x-livewire-component class="w-full">

    <h2 class="text-2xl font-semibold text-center select-none text-gray-800/70">Create your {{ config('app.name') }} account</h2>

    <div x-data="{ usingEmail: @entangle('usingEmail') }" class="flex flex-col items-center mt-6 select-none">
        
        <a x-show="!usingEmail" href="{{ route('register') }}" class="px-5 font-semibold inline-block py-2.5 bg-green-600 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 border border-green-700 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-green-700 focus:outline-none focus:shadow text-green-50/100 shadow-sm hover:shadow-md hover:text-green-50 active:shadow-inner w-full text-center">
            Continue with Google
        </a>

        <button type="button" x-show="!usingEmail" x-on:click="usingEmail = !usingEmail;$focus.focus($refs.name)" class="px-5 font-semibold inline-block py-2.5 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner w-full text-center mt-2">
            Continue with email
        </button>

        <div x-cloak x-show="usingEmail" class="w-full pb-3">

            <form wire:submit.prevent="attempt" class="space-y-4">

                @error('status')
                    <div class="text-xs text-center text-red-400">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
        
                <div>
                    <x-forms.label for="name" required class="block mb-1 text-gray-800">What is your name?</x-forms.label>
                    <x-forms.input type="text" id="name" x-ref="name" wire:model.defer="name" autofocus />
                    <x-forms.validation-error for="name" />
                </div>

                <div>
                    <x-forms.label for="email" required class="block mb-1 text-gray-800">What is your email address</x-forms.label>
                    <x-forms.input type="email" id="email" wire:model.defer="email" />
                    <x-forms.validation-error for="email" />
                </div>
        
                <div>
                    <x-forms.label for="password" required class="block mb-1 text-gray-800">Enter your desired password</x-forms.label>
                    <x-forms.input type="password" id="password" wire:model.defer="password" />
                    <x-forms.validation-error for="password" />
                </div>
        
                <div>
                    <x-forms.label for="password_confirmation" required class="block mb-1 text-gray-800">
                        Confirm your desired password
                    </x-forms.label>
                    <x-forms.input type="password" id="password_confirmation" wire:model.defer="password_confirmation" />
                    <x-forms.validation-error for="password_confirmation" />
                </div>
        
                <button type="submit" class="px-5 font-semibold inline-block py-2.5 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner w-full text-center mt-2 disabled:opacity-75 disabled:bg-gray-200">
                    Sign up
                </button>
        
            </form>

        </div>

    </div>

</x-livewire-component>