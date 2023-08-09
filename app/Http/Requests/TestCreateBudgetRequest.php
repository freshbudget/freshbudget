<?php

namespace App\Http\Requests;

use App\Domains\Budgets\Models\Budget;
use Illuminate\Foundation\Http\FormRequest;

class TestCreateBudgetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => $this->user()->id,
        ]);
    }

    public function attempt()
    {
        $budget = Budget::create([
            'name' => $this->input('name'),
        ]);
    }
}
