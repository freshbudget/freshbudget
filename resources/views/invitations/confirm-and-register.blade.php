@extends('layouts.marketing')

@section('page')

    <main class="max-w-3xl px-4 mx-auto">

        <h2 class="text-4xl font-black tracking-tight text-gray-800 sm:text-6xl selection:bg-gray-300/70">
            Accept Invitation?
        </h2>

    </main>

    <section class="max-w-3xl px-4 mx-auto mt-20 prose prose-lg prose-green">
        
        <p>
            You have been invited to join the budget <strong>{{ $invitation->budget->name }}</strong> by <strong>{{ $invitation->sender->name }}</strong>. They sent you this invitation on <strong>{{ $invitation->created_at->format('F j, Y') }}</strong>, and it will expire on <strong>{{ $invitation->expires_at->format('F j, Y') }}</strong>.
        </p>

        <p>
            If you accept this invitation, you will be able to view and collaborate on the budget, and can leave the budget at any time. However, before you can join the budget, you must first register for an account. You can do so by clicking the <strong>Accept and Register</strong> button below.
        </p>

        <p>
            If you do not want to join the budget, you can reject this invitation by clicking the <strong>Reject</strong> button below. By rejecting this invitation, you will not be able to view or edit the budget. However, you are free to create your own budget by registering for an account &mdash; and you can request the sender to invite you to their budget again at a later date.
        </p>

        <div class="mt-6 space-x-2 select-none flex items-center">

            <x-forms.buttons.secondary>
                Accept and Register
            </x-forms.buttons.secondary>


            <form method="POST" action="{{ route('invitations.reject', $invitation) . '?token=' . $invitation->token }}">
                @csrf

                <x-forms.buttons.danger type="submit">
                    Decline Invitation
                </x-forms.buttons.danger>
            </form>

        </div>

    </section>
    
@endsection