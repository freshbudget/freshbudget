<?php

namespace App\Controllers\Invitations;

use App\Controllers\Controller;
use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Users\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class BudgetInvitationsController extends Controller
{
    public function show(string $invitation, Request $request)
    {
        $invitation = BudgetInvitation::where('ulid', $invitation)->first();

        // check if the invitation exists
        if (! $invitation) {
            return view('invitations.not-found');
        }

        // check if the token matches the invitation token
        if ($invitation->token != $request->token) {
            return view('invitations.not-found');
        }

        // okay need to check if the invitation is expired
        if ($invitation->isExpired()) {
            $invitation->markAsExpired();

            return view('invitations.expired');
        }

        // okay, now we need to check if the invitation has already been accepted
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
            // we need to check if the user is already logged in and if they are not the user that the invitation was sent to
            if (user() && user()->id != $user->id) {
                // okay, the user is logged in but they are not the user that the invitation was sent to, something is wrong, let's show them an error
                return view('invitations.not-found');
            }

            // user already has an account, let's confirm that they want to accept the invitation
            return view('invitations.confirm', [
                'invitation' => $invitation,
            ]);
        }

        // okay, the user doesn't have an account, let's show they a page where they can make an informed decision about whether or not
        // they want to create an account and accept the invitation
        return view('invitations.confirm-and-register', [
            'invitation' => $invitation,
        ]);

        // all this should be moved to another controller method if the user decides to accept the invitation

        // start a transaction
        DB::beginTransaction();

        try {

            // maybe i shouldnt automatically create an account for the user, maybe i should just show them a form where they can create an
            // account, that way they can choose to accept the terms of service and privacy policy before creating an account and then they
            //could set a password and change their name, etc.

            // okay, the user doesn't have an account, let's create one
            $user = User::create([
                'name' => $invitation->name,
                'nickname' => $invitation->nickname,
                'email' => $invitation->email,
                'password' => str()->random(32),
                'registration_source' => User::REGISTERED_VIA_INVITATION,
            ]);

            // okay, now let's accept the invitation
            $user->acceptBudgetInvitation($invitation);

            // okay, lets set the users current budget to the budget they were invited to so when they login they see the budget
            $user->switchCurrentBudget($invitation->budget);

            // okay, now we need to send the user a welcome email and have them set a password
            Password::sendResetLink(['email' => $user->email]);

            // commit the transaction
            DB::commit();

        } catch (Exception $e) {
            // rollback the transaction
            DB::rollBack();

            // rethrow the exception
            throw $e;
        }

        // okay, now we need to redirect th user to a onboarding page where they can set a password, change their name, etc.
        // todo: create the onboarding page
    }

    public function reject(BudgetInvitation $invitation, Request $request)
    {
        //
    }

    public function accept(BudgetInvitation $invitation, Request $request)
    {
        // check if the token matches the invitation token
        if ($invitation->token != $request->token) {
            return view('invitations.not-found');
        }

        // okay need to check if the invitation is still pending
        if (! $invitation->isPending()) {
            return view('invitations.not-found');
        }

        // first we need to check if the user already has an account
        $user = User::where('email', $invitation->email)->first();

        if ($user) {
            // okay, the user already has an account, let's accept the invitation
            $user->acceptBudgetInvitation($invitation);

            // switch the users current budget to the budget they were invited to
            $user->switchCurrentBudget($invitation->budget);

            // maybe flash a message to the user?

            // okay, now we need to redirect the user to the budget they were invited to
            return redirect()->route('app.index');
        } else {
            dd('the user does not have an account, we need to create one and then accept the invitation.');
        }
    }
}
