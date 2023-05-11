<x-livewire-component>

    @if (auth()->user()->hasVerifiedEmail())

        <h2>Your email is verified</h2>

        <p>
            Your good to go. You can now access all the features of the site.
        </p>
        
    @else

        <h2>Verify email before continuing</h2>

        <hr>

        <p>
            We have sent you an email with a link to verify your email address. 
            Please click the link in the email to continue. Or if you have not
            received the email you can click the button below to resend the email.
        </p>

        @if(session()->has('status'))
            <p>{{ session('status') }}</p>
            @endif
            
        @error('status')
            <p>{{ $message }}</p>
        @enderror

        <form wire:submit.prevent="attempt">
            <button type="submit">Resend verification email</button>
        </form>

    @endif

</x-livewire-component>