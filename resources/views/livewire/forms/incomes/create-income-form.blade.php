<form wire:submit.prevent="attempt" class="space-y-6">

    <div class="space-y-2">
        <x-forms.label for="name" required>
            What should we call this income?
        </x-forms.label>

        <x-forms.input type="text" name="name" id="name" autofocus />
    </div>

    <div class="space-y-2">
        <x-forms.label for="type_id" required>
            What type of income is this?
        </x-forms.label>

        <x-forms.select name="type_id" id="type_id">
            <option value="">Select a type</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </x-forms.select>
    </div>

    <div class="space-y-2">
        <x-forms.label for="frequency_id" required>
            How often do you recieve installments of this income?
        </x-forms.label>

        <x-forms.select name="frequency_id" id="frequency_id">
            <option value="">Select a frequency</option>
            @foreach ($frequencies as $frequency)
                <option value="{{ $frequency->id }}">{{ $frequency->name }}</option>
            @endforeach
        </x-forms.select>
    </div>

    <div class="space-y-2" x-data="">
        <x-forms.label for="amount" required>
            When you recieve installments of this income, how much do you recieve? You should include any taxes or fees that are taken out of the income.
        </x-forms.label>

        <x-forms.icon-prefixed-input icon="dollar" type="text" name="amount" id="amount" x-mask:dynamic="$money($input)" />
    </div>

    <div class="space-y-2">
        <x-forms.label for="user_ulid">
            Who would you say this income is associated with?
        </x-forms.label>

        <x-forms.select name="user_ulid" id="user_ulid">
            <option value="">Select a user</option>
            @foreach ($users as $user)
                <option value="{{ $user->ulid }}">{{ $user->name }}</option>
            @endforeach
        </x-forms.select>
    </div>
    
    <div class="space-y-2">
        <x-forms.label for="description">
            If you had to describe this income in one sentence, what would you say?
        </x-forms.label>

        <x-forms.input type="text" name="description" id="description" />
    </div>

</form>