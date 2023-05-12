<x-livewire-component class="w-full">

    <h2 class="text-2xl font-semibold text-center select-none text-gray-800/70">Login to your account</h2>

    <div x-data="{ usingEmail: @entangle('usingEmail') }" class="flex flex-col items-center mt-6 select-none">
        
        <a x-show="!usingEmail" href="{{ route('register') }}" class="px-5 font-semibold inline-block py-2.5 bg-green-600 hover:bg-gradient-to-br hover:from-green-500 hover:to-green-600 border border-green-700 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-green-700 focus:outline-none focus:shadow text-green-50/100 shadow-sm hover:shadow-md hover:text-green-50 active:shadow-inner w-full text-center">
            Continue with Google
        </a>

        <div x-cloak x-show="usingEmail" class="w-full pb-3">

            <form wire:submit.prevent="attempt" class="space-y-3">

                @error('status')
                    <div class="text-xs text-center text-red-400">
                        <span>{{ $message }}</span>
                    </div>
                @enderror
        
                <div>
                    <x-forms.label for="email" required class="sr-only">Email address</x-forms.label>
                    <input type="email" id="email" x-ref="email" wire:model="email" placeholder="Enter your email address" class="block w-full transition duration-75 border-gray-300 rounded-lg focus:outline-none ring-green-500 focus:border-gray-300 focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-green-400">
                    @error('email') <span class="text-sm text-red-400">{{ $message }}</span> @enderror
                </div>
        
                <div>
                    <x-forms.label for="password" required class="sr-only">Enter your password</x-forms.label>
                    <input type="password" id="password" wire:model="password" placeholder="Enter your password" class="block w-full transition duration-75 border-gray-300 rounded-lg focus:outline-none ring-green-500 focus:border-gray-300 focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-green-400">
                    @error('password') <span class="text-sm text-red-400">{{ $message }}</span> @enderror
                </div>
        
                <button type="submit" class="px-5 font-semibold inline-block py-2.5 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner w-full text-center mt-2 disabled:opacity-75 disabled:bg-gray-200">
                    Login
                </button>
        
            </form>

        </div>

        <button type="button" x-show="!usingEmail" x-on:click="usingEmail = !usingEmail;$focus.focus($refs.email)" class="px-5 font-semibold inline-block py-2.5 bg-gray-100 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900 active:shadow-inner w-full text-center mt-2">
            Continue with email
        </button>

    </div>

</x-livewire-component>