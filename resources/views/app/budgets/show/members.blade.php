@extends('app.budgets.show.layout')

@section('page::title', $budget->name)
@section('breadcrumbs', Breadcrumbs::render('app.budgets.index'))

@section('tab')

    <section class="border border-gray-300 bg-white rounded my-8">

        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
            <h2 class="font-semibold text-gray-700">Invite Member</h2>
        </header>

        <form id="invite-form" action="{{ route('app.budgets.members.store', $budget) }}" method="post" class="p-4">

            @csrf
            
            <div class="flex space-x-3 text-sm">

                <div class="space-y-2 w-full">
                    <x-forms.label for="name" required>
                        Name
                    </x-forms.label>
            
                    <x-forms.input type="text" name="name" id="name" />
                    
                    <x-forms.validation-error for="name" />
                </div>
    
                <div class="space-y-2 w-full">
                    <x-forms.label for="email" required>
                        Email
                    </x-forms.label>
            
                    <x-forms.input type="text" name="email" id="email" />
                    
                    <x-forms.validation-error for="email" />
                </div>

                <div class="space-y-2 w-full">
                    <x-forms.label for="role">
                        Role
                    </x-forms.label>
            
                    <x-forms.select name="role" id="role">
                        <option value="admin">Admin</option>
                        <option value="member" selected>Member</option>
                        <option value="persona">Persona</option>
                    </x-forms.select>
                    
                    <x-forms.validation-error for="role" />
                </div>

                <x-forms.validation-error for="error" />
            </div>

        </form>

        <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
            <x-forms.buttons.primary form="invite-form">
                Send Invite
            </x-forms.buttons.primary>
        </footer>

    </section>

    <section class="border border-gray-300 bg-white rounded my-8" x-data="{ search: '' }">
        
        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none flex items-center justify-between">
            <h2 class="font-semibold text-gray-700 text-lg">Members</h2>

            <div>
                <x-forms.input type="text" placeholder="Search" x-model="search" x-on:keydown.escape.window="search=''" />
            </div>
        </header>

        <main class=" bg-white rounded-b">

            <ul class="divide-y">

                @foreach ($budget->members as $member)
    
                    <li x-search="search" class="px-4 flex items-center justify-between py-3">
                        <div>
                            <h3 class="font-semibold text-lg text-gray-700">
                                {{ $member->name }} @if($member->nickname) <span class="text-sm">({{ $member->nickname }})</span> @endif
                            </h3>
                            <p class="text-gray-500">{{ $member->email }}</p>
                        </div>
                        <div>
                            <x-forms.buttons.secondary>
                                Menu
                            </x-forms.buttons.secondary>
                        </div>
                    </li>
                    
                @endforeach

            </ul>

        </main>

    </section>

    <section class="border border-gray-300 bg-white rounded my-8" x-data="{ search: '' }">
        
        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none flex items-center justify-between">
            <h2 class="font-semibold text-gray-700 text-lg">Invited Members</h2>

            <div>
                <x-forms.input type="text" placeholder="Search" x-model="search" x-on:keydown.escape.window="search=''" />
            </div>
        </header>

        <main class=" bg-white rounded-b">

            <ul class="divide-y select-none">

                @if($budget->pendingInvitations->count() == 0)
                    <li class="p-6 text-center">
                        <p class="text-gray-500">No pending invitations.</p>
                    </li>
                @endif
                @foreach ($budget->pendingInvitations as $member)
    
                    <li x-search="search" class="px-4 flex items-center justify-between py-3">
                        <div>
                            <h3 class="font-semibold text-lg text-gray-700">
                                {{ $member->name }} @if($member->nickname) <span class="text-sm">({{ $member->nickname }})</span> @endif
                            </h3>
                            <p class="text-gray-500">{{ $member->email }}</p>
                            <p class="text-gray-500">Expires: {{ $member->expires_at->diffForHumans() }}</p>
                            <p class="text-gray-500">Invited by: {{ $member->sender->name }}</p>
                        </div>
                        <div>
                            <form action="{{ route('app.budgets.invitations.destroy', ['budget' => $budget, 'invitation' => $member]) }}" method="post">
                                @csrf
                                @method('delete')
                                <x-forms.buttons.danger type="submit">
                                    Cancel Invite
                                </x-forms.buttons.danger>
                            </form>
                        </div>
                    </li>
                    
                @endforeach

            </ul>

        </main>

    </section>
    
@endsection