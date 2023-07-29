<div class="border border-gray-300 bg-white rounded my-8">

    <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none flex items-center justify-between">
        <h2 class="font-semibold text-gray-700 text-lg">Pending Invitations</h2>

        <div>
            <x-forms.input type="search" placeholder="Search" wire:model.live="search" />
        </div>
    </header>

    <main class="bg-white rounded-b">

        <ul class="divide-y select-none">

            @if($invitations->count() == 0)
                <li class="p-6 text-center">
                    <p class="text-gray-500">No pending invitations found.</p>
                </li>
            @endif

            @foreach ($invitations as $member)

                <li x-search="search" class="px-4 flex items-center justify-between py-3">
                    <div>
                        <h3 class="font-semibold text-lg text-gray-700">
                            {{ $member->name }} @if($member->nickname) <span class="text-sm">({{ $member->nickname }})</span> @endif
                        </h3>
                        
                        <div class="flex items-center space-x-2 my-1">
                                
                            <p class="text-gray-500 border rounded-full border-gray-300 text-xs px-2 py-0.5 w-16 text-center">
                                {{ str($member->role)->title() }}
                            </p>

                            @if($member->email)
                                <p class="text-gray-500 flex items-center">
                                    {{ $member->email }}
                                </p>
                            @endif

                        </div>

                    </div>
                    <div>
                        <x-context-menu>
                            <x-forms.buttons.secondary x-on:click="contextMenuToggle" class="p-1.5 flex items-center justify-center">
                                @svg('more-vertical', 'w-5 h-5 text-gray-500')
                            </x-forms.buttons.secondary>
                            <x-slot:options>
                                {{ $member->id }}
                            </x-slot:options>
                        </x-context-menu>
                    </div>
                </li>
                
            @endforeach

        </ul>

    </main>

</div>