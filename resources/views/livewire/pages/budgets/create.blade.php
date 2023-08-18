@section('breadcrumbs', Breadcrumbs::render('app.budgets.index'))
@section('page::title', 'Create Budget')

<div class="max-w-xl p-4 mx-auto mb-8">
        
    <form wire:submit="attempt" class="space-y-4">

        <div class="space-y-2">
            <x-forms.label for="name" required>
                What should we call this budget?
            </x-forms.label>
    
            <x-forms.input type="text" name="name" id="name" wire:model="name" autofocus />
            
            <x-forms.validation-error for="name" />
        </div>
        
        <div class="flex items-center justify-end">  
            <x-forms.buttons.primary type="submit">
                Create Budget
            </x-forms.buttons.primary>
        </div>
        
    </form>

</div>