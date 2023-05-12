<?php

namespace App\Http\Controllers\Invitations;

use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Users\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class BudgetInvitationsController extends Controller
{
    public function show(string $invitation, Request $request)
    {
        $invitation = BudgetInvitation::where('ulid', $invitation)->firstOrFail();

        // check if the token matches the invitation token
        if (! $invitation->token === $request->token) {
            return view('invitations.not-found');
        }

        // okay need to check if the invitation is expired
        if ($invitation->isExpired()) {
            $invitation->markAsExpired();

            return view('invitations.expired');
        }

        // okay, now we need to check if the invitation has been accepted
        if ($invitation->isAccepted()) {
            return view('invitations.accepted');
        }

        // okay, now we need to check if the invitation has been rejected
        if ($invitation->isRejected()) {
            return view('invitations.rejected');
        }

        // okay so the invitation is pending, let's check if the user already has an account
        $user = User::where('email', $invitation->email)->first();

        if ($user) {
            // okay, the user already has an account, let's accept the invitation
            $invitation->accept($user);

            return view('invitations.accept');
        }

        // start a transaction
        DB::beginTransaction();

        // okay, the user doesn't have an account, let's create one
        $user = User::create([
            'name' => $invitation->name,
            'nickname' => $invitation->nickname,
            'email' => $invitation->email,
            'password' => str()->random(32),
        ]);

        // okay, now let's accept the invitation
        $invitation->accept($user);

        // okay, lets set the users current budget to the budget they were invited to
        $user->switchCurrentBudget($invitation->budget);

        // okay, now we need to send the user a welcome email and have them set a password
        Password::sendResetLink(['email' => $user->email]);

        // commit the transaction
        DB::commit();

        // okay, now we need to redirect th user to a onboarding page where they can set a password, change their name, etc.
        // todo: create the onboarding page
    }
}
