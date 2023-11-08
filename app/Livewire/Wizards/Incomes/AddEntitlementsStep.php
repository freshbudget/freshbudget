<?php 

namespace App\Livewire\Wizards\Incomes;

use Spatie\LivewireWizard\Components\StepComponent;

class AddEntitlementsStep extends StepComponent
{
    public function view()
    {
        return view('livewire.wizards.incomes.add-entitlements-step');
    }
}