<?php 

namespace App\Livewire\Wizards\Incomes;

use App\Livewire\Wizards\Incomes\AddEntitlementsStep;
use Spatie\LivewireWizard\Components\WizardComponent;

class ConfigureIncomeWizard extends WizardComponent
{
    public function steps(): array
    {
        return [
            AddEntitlementsStep::class,
        ];
    }
}