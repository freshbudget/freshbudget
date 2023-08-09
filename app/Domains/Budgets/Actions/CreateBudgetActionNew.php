<?php

namespace App\Domains\Budgets\Actions;

use App\Domains\Shared\Enums\Currency;
use App\Domains\Users\Models\User;
use Gate;
use Illuminate\Validation\Rules\Enum;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateBudgetActionNew
{
    use AsAction;

    public function rules(): array
    {
        return [
            'user' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'currency' => ['required', 'string', new Enum(Currency::class)],
            'personal' => ['required', 'boolean'],
        ];
    }

    public function authorize(ActionRequest $request): bool
    {
        return Gate::check('create', Budget::class);
    }

    public function handle(User $user, $data)
    {
        return $user->ownedBudgets()->create($data);
    }
}
