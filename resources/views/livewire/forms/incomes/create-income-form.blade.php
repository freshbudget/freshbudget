<form wire:submit.prevent="attempt" class="space-y-6">

    <div class="space-y-2">
        <x-forms.label for="name" required>
            What should we call this income?
        </x-forms.label>

        <x-forms.input type="text" name="name" id="name" wire:model.defer="name" autofocus />
        <x-forms.validation-error for="name" />
    </div>

    <div class="space-y-2">
        <x-forms.label for="type_id" required>
            What type of income is this?
        </x-forms.label>

        <x-forms.select name="type_id" id="type_id" wire:model.defer="type_id">
            <option value="">Select a type</option>
            @foreach ($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.validation-error for="type_id" />
    </div>

    <div class="space-y-2">
        <x-forms.label for="frequency_id" required>
            How often do you recieve installments of this income?
        </x-forms.label>

        <x-forms.select name="frequency_id" id="frequency_id" wire:model.defer="frequency_id">
            <option value="">Select a frequency</option>
            @foreach ($frequencies as $frequency)
                <option value="{{ $frequency->id }}">{{ $frequency->name }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.validation-error for="frequency_id" />
    </div>

    <div class="space-y-2">
        <x-forms.label for="user_ulid">
            Who, in your budget, would you say this income is associated with?
        </x-forms.label>

        <x-forms.select name="user_ulid" id="user_ulid" wire:model.defer="user_ulid">
            <option value="">Select a user</option>
            @foreach ($users as $user)
                <option value="{{ $user->ulid }}">{{ $user->name }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.validation-error for="user_ulid" />
    </div>

    <div class="flex items-center justify-end">
        <x-forms.buttons.primary type="submit">
            Next Step
        </x-forms.buttons.primary>
    </div>

</form>