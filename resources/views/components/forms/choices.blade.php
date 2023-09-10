@props([
    'options' => [], 
    'optionValue' => 'id',
    'optionLabel' => 'name',
    'multiple' => false, 
])

@pushOnce('body::end')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />    
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>    
@endPushOnce

<div wire:ignore x-data="{
    library: null,
    value: 0,
    options: [
        @foreach($options as $option)
            { value: '{{ $option->{$optionValue} }}', label: '{{ $option->{$optionLabel} }}' },
        @endforeach
    ],
    choices: null,
    
    init() {
        this.$nextTick(() => {
            this.choices = new Choices(this.$refs.select, {
                addItems: true,
            })

            this.$refs.select.addEventListener('addItem', ({ detail: { value } }) => {
                // do something creative here...
                console.log(event.detail.id);
                console.log(event.detail.value);
                console.log(event.detail.label);
            }, false)

            this.$refs.select.addEventListener('add', ({ detail: { value } }) => {
                // do something creative here...
                console.log(event.detail.id);
                console.log(event.detail.value);
                console.log(event.detail.label);
            }, false)

            let refreshChoices = () => {
                let selection = this.multiple ? this.value : [this.value]

                this.choices.clearStore()
                this.choices.setChoices(this.options.map(({ value, label }) => ({
                    value,
                    label,
                    selected: selection.includes(value),
                })))
            }

            refreshChoices()

            this.$refs.select.addEventListener('change', () => {
                this.value = this.choices.getValue(true)
            })

            this.$watch('value', () => refreshChoices())
            this.$watch('options', () => refreshChoices())
        })
    }

}">
    <x-forms.select x-ref="select">
        <option value="">Test</option>
    </x-forms.select>
</div>