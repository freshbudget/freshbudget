@extends('layouts.app')

@section('breadcrumbs', Breadcrumbs::render('app.transactions.index'))
@section('page::title', 'Create Transaction')

@section('content')

    <div class="max-w-3xl p-4 mx-auto mb-8">
        
        <form class="border border-gray-300 bg-white rounded my-8" wire:submit="attempt">

            <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
                <h2 class="font-semibold text-gray-700">Create Transaction</h2>
            </header>
        
            <main class="p-4">
        
                <div class="space-y-4">
        
                    <div class="space-y-2">
                        <x-forms.label for="name" required>
                            What should we title this transaction?
                        </x-forms.label>
                
                        <x-forms.input type="text" name="name" id="name" wire:model="name" autofocus />
                        
                        <x-forms.validation-error for="name" />
                    </div>
                
                    <div class="space-y-2">
                        <x-forms.label for="subtype_id" required>
                            What account is the money coming from?
                        </x-forms.label>
                
                        <x-forms.select name="subtype_id" id="subtype_id" wire:model="subtype_id">
                            <option value="">Select a type</option>
                            @foreach ($accounts as $account)
                                <option value="{{ $account->ulid }}">{{ $account->name }}</option>
                            @endforeach
                        </x-forms.select>
                
                        <x-forms.validation-error for="subtype_id" />
                    </div>

                    <div class="space-y-2">
                        <x-forms.label for="subtype_id" required>
                            What account is the money going to?
                        </x-forms.label>
                
                        <x-forms.select name="subtype_id" id="subtype_id" wire:model="subtype_id">
                            <option value="">Select a type</option>
                            @foreach ($accounts as $account)
                                <option value="{{ $account->ulid }}">{{ $account->name }}</option>
                            @endforeach
                        </x-forms.select>
                
                        <x-forms.validation-error for="subtype_id" />
                    </div>

                    <div class="space-y-2">
                        <x-forms.label for="name" required>
                            What should we title this transaction?
                        </x-forms.label>
                
                        <x-forms.input type="text" name="name" id="name" wire:model="name" autofocus />
                        
                        <x-forms.validation-error for="name" />
                    </div>
        
                </div>
        
            </main>
        
            <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
                
                <x-forms.buttons.primary type="submit" wire:loading.attr="disabled">
                    Create Income
                </x-forms.buttons.primary>
        
            </footer>
        
        </form>

    </div>
    
@endsection