@extends('app.incomes.show.layout')

@section('tab')

<div>

    <form action="{{ route('app.incomes.update', $income) }}" method="post" class="max-w-xl space-y-4">
        
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

    <hr class="my-8">

    <form action="{{ route('app.incomes.destroy', $income) }}" method="post" >
        @csrf
        @method('delete')
        
        <x-forms.buttons.primary type="submit">
            Delete Income
        </x-forms.buttons.primary>
    
    </form>
    
</div>

@endsection