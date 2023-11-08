<x-livewire-component>

    @if (user()->hasVerifiedEmail())

        <h2 class="text-2xl font-semibold text-center select-none text-gray-800/70">Verify your email address</h2>

        <p>
            Your good to go. You can now access all the features of the site.
        </p>
        
    @else

        <div class="prose prose-lg">

            <h2>Verify your email address</h2>
    
            <p>
                Before you can access the application you need to verify your email address. Please check your email for a verification link.
            </p>

            <p>
               If you did not receive the email, please check your spam folder or click the button below to resend the email.
            </p>

        </div>

        @if(session()->has('status'))
    
            <div class="p-4 my-8 bg-green-200 rounded-md select-none" x-data x-ref="alert">
                <div class="flex">
                    
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                    </div>
                    
                    <div class="pl-3 ml-auto">
                        
                        <div class="-mx-1.5 -my-1.5">
                            <button x-on:click="$refs.alert.remove()" type="button" class="inline-flex rounded-md bg-green-200 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-200">
                                <span class="sr-only">Dismiss</span>
                                @svg('x', 'w-5 h-5')
                            </button>
                        </div>

                    </div>

                </div>
            </div>

        @endif
            
        @error('status')
            <div class="p-4 my-8 bg-red-200 rounded-md select-none" x-data x-ref="alert">
                <div class="flex">
                    
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ $message }}</p>
                    </div>
                    
                    <div class="pl-3 ml-auto">
                        
                        <div class="-mx-1.5 -my-1.5">
                            <button x-on:click="$refs.alert.remove()" type="button" class="inline-flex rounded-md bg-red-200 p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-200">
                                <span class="sr-only">Dismiss</span>
                                @svg('x', 'w-5 h-5')
                            </button>
                        </div>

                    </div>

                </div>
            </div>
        @enderror

        <form wire:submit="attempt" class="flex items-center justify-center my-8 select-none">
            <button type="submit" class="px-5 font-semibold inline-block py-2.5 bg-gray-50 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 border border-gray-300 rounded-lg focus:ring-2 ring-offset-2 ring-offset-white ring-gray-400 focus:outline-none focus:shadow text-gray-700 shadow-sm hover:shadow hover:text-gray-900">
                Resend verification email
            </button>
        </form>

    @endif

</x-livewire-component>