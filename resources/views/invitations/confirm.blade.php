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
            If you accept this invitation, you will be able to view and collaborate on the budget, and can leave the budget at any time. 
        </p>

        <p>
            If you do not want to join the budget, you can reject this invitation by clicking the <strong>Reject</strong> button below. By rejecting this invitation, you will not be able to view or edit the budget, and the sender will not be able to send you another invitation without action on your part.
        </p>

        <div class="space-x-2 select-none">

            <a href="#" class="inline-block px-3 py-2 text-base font-semibold text-gray-700 no-underline border border-gray-300 rounded-lg shadow-sm bg-gray-50 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 focus:ring-2 ring-offset-2 ring-offset-white ring-green-400 focus:outline-none focus:shadow hover:shadow hover:text-gray-900">
                Accept Invitation
            </a>

            <a href="#" class="inline-block px-3 py-2 text-base font-semibold text-gray-700 no-underline border border-gray-300 rounded-lg shadow-sm bg-gray-50 hover:bg-gradient-to-br hover:from-white hover:to-gray-100 focus:ring-2 ring-offset-2 ring-offset-white ring-red-400 focus:outline-none focus:shadow hover:shadow hover:text-gray-900">
                Reject Invitation
            </a>

        </div>

    </section>
    
@endsection