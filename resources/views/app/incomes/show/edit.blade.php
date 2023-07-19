@extends('app.incomes.show.layout')

@section('tab')

<div class="max-w-3xl mx-auto px-4">

    <!-- Edit form -->
    <section class="border border-gray-300 bg-white rounded my-8">
    
        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
            <h2 class="font-semibold text-gray-700">General Settings</h2>
        </header>
    
    
        <form id="edit-form" action="{{ route('app.incomes.update', $income) }}" method="post" class="p-4">
            
            @csrf
            @method('PUT')
    
            <div class="space-y-4">

                <div class="space-y-2">
                    <x-forms.label for="name" required>
                        Income Name
                    </x-forms.label>
            
                    <x-forms.input type="text" name="name" id="name" value="{{ $income->name }}" />
                    
                    <x-forms.validation-error for="name" />
                </div>
    
                <div>
                    <x-forms.label for="type_id" required class="block mb-1 text-gray-800">Income Type</x-forms.label>
                    <x-forms.select id="type_id" name="type_id">
                        @foreach ($types as $type)
                            <option 
                                value="{{ $type->id }}" @selected($income->type_id == $type->id)>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </x-forms.select>
                    <x-forms.validation-error for="type_id" />
                </div>
        
                <div>
                    <x-forms.label for="frequency" required class="block mb-1 text-gray-800">Income Frequency</x-forms.label>
                    <x-forms.select id="frequency" name="frequency">
                        @foreach ($frequencies as $frequency)
                            <option 
                                value="{{ $frequency->value }}" @selected($income->frequency == $frequency)>
                                {{ $frequency->value }}
                            </option>
                        @endforeach
                    </x-forms.select>
                    <x-forms.validation-error for="frequency" />
                </div>
        
                <div>
                    <x-forms.label for="url" class="block mb-1 text-gray-800">Income URL</x-forms.label>
                    <x-forms.input type="url" name="url" id="url" :value="$income->url" />
                    <x-forms.validation-error for="url" />
                </div>

            </div>
    
        </form>
    
        <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
            <x-forms.buttons.primary form="edit-form">
                Save Changes
            </x-forms.buttons.primary>
        </footer>
    
    </section>

    <!-- Delete form -->
    <section class="border border-gray-300 bg-white rounded my-8">

        <header class="border-b rounded-t border-gray-300 px-4 py-3 select-none">
            <h2 class="font-semibold text-gray-700">Delete Income</h2>
        </header>
    
        <form id="delete-form" action="{{ route('app.incomes.destroy', $income) }}" method="post" class="p-4 select-none">
            
            @csrf
            @method('DELETE')
    
            <p>
                Are you sure you want to delete this income? This action cannot be undone. When you delete a income, all of its data will be deleted. This includes all of it's transactions and files.
            </p>
    
        </form>
    
        <footer class="rounded-b border-t border-gray-300 bg-gray-50 px-4 py-3 flex items-center justify-end">
            <x-forms.buttons.danger confirm="true" type="submit" form="delete-form">
                Delete Income
            </x-forms.buttons.danger>
        </footer>
    
    </section>

</div>

<div>

    {{-- <form action="{{ route('app.incomes.update', $income) }}" method="post" class="max-w-xl space-y-4">
        
        <div>
            <x-forms.label for="name" required class="block mb-1 text-gray-800">Income Name</x-forms.label>
            <x-forms.input type="text" name="name" id="name" :value="$income->name" />
            <x-forms.validation-error for="name" />
        </div>

        <div>
            <x-forms.label for="type_id" required class="block mb-1 text-gray-800">Income Type</x-forms.label>
            <x-forms.select id="type_id" name="type_id">
                @foreach ($types as $type)
                    <option 
                        value="{{ $type->id }}" @selected($income->type_id == $type->id)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </x-forms.select>
            <x-forms.validation-error for="type_id" />
        </div>

        <div>
            <x-forms.label for="frequency" required class="block mb-1 text-gray-800">Income Frequency</x-forms.label>
            <x-forms.select id="frequency" name="frequency">
                @foreach ($frequencies as $frequency)
                    <option 
                        value="{{ $frequency->value }}" @selected($income->frequency == $frequency)>
                        {{ $frequency->value }}
                    </option>
                @endforeach
            </x-forms.select>
            <x-forms.validation-error for="frequency" />
        </div>

        <div>
            <x-forms.label for="url" class="block mb-1 text-gray-800">Income URL</x-forms.label>
            <x-forms.input type="url" name="url" id="url" :value="$income->url" />
            <x-forms.validation-error for="url" />
        </div>

        <div class="flex items-center justify-end">
            <x-forms.buttons.primary type="submit">
                Update Income
            </x-forms.buttons.primary>
        </div>

        @csrf        
        @method('put')

    </form>
 --}}

    
</div>

@endsection