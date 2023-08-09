<?php 

use App\Support\FormAction;

class TestAction extends FormAction
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }

    public function handle()
    {
        return 'handled';
    }

    public bool $testMethodWasCalled = false;

    public function testMethod()
    {
        $this->testMethodWasCalled = true;
    }
}

test('the FormActionTesterClass works', function() {

    $tester = FormAction::test(TestAction::class)
        ->call('testMethod');

    expect($tester->action->testMethodWasCalled)->toBeTrue();
    
});