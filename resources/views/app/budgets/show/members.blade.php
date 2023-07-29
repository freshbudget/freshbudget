@extends('app.budgets.show.layout')

@section('page::title', $budget->name)
@section('breadcrumbs', Breadcrumbs::render('app.budgets.index'))

@section('tab')

    @livewire(\App\Livewire\Panels\Budgets\InviteMemberPanel::class, ['budgetUlid' => $budget->ulid])

    <section class="border border-gray-300 bg-white rounded my-8" x-data="{ search: '' }">
        
        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none flex items-center justify-between">
            <h2 class="font-semibold text-gray-700 text-lg">Members</h2>

            <div>
                <x-forms.input type="search" placeholder="Search" x-model="search" x-on:keydown.escape.window="search=''" />
            </div>
        </header>

        <main class=" bg-white rounded-b">

            <ul class="divide-y">

                @foreach ($budget->members as $member)
    
                    <li x-search="search" class="px-4 flex items-center justify-between py-3 select-none">
                        <div>
                            
                            <h3 class="font-semibold text-lg text-gray-700 truncate">
                                {{ $member->name }} @if($member->nickname) <span class="text-sm truncate">({{ $member->nickname }})</span> @endif
                            </h3>

                            <div class="flex items-center space-x-2 my-1">
                                
                                @if($budget->isOwnedBy($member))

                                    <p class="text-gray-500 border rounded-full border-gray-300 text-xs px-2 py-0.5 w-14 text-center">
                                        Owner
                                    </p>

                                @else

                                    <p class="text-gray-500 border rounded-full border-gray-300 text-xs px-2 py-0.5 w-16 text-center">
                                        Admin
                                    </p>

                                @endif

                                @if($member->email)
                                    <p class="text-gray-500 flex items-center">
                                        {{ $member->email }}
                                    </p>
                                @endif

                            </div>

                        </div>

                        <div>
                            <x-forms.buttons.secondary class="p-1.5 flex items-center justify-center">
                                @svg('more-vertical', 'w-5 h-5 text-gray-500')
                            </x-forms.buttons.secondary>
                        </div>
                        
                    </li>
                    
                @endforeach

            </ul>

        </main>

    </section>

    @livewire(\App\Livewire\Panels\Budgets\PendingInvitationsPanel::class, ['budgetUlid' => $budget->ulid])

    <div class="mb-20 h-10"></div>
    
@endsection