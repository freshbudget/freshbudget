<?php

namespace Database\Factories;

use App\Domains\Budgets\Models\Budget;
use App\Domains\Budgets\Models\BudgetInvitation;
use App\Domains\Users\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetInvitationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BudgetInvitation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'token' => BudgetInvitation::generateToken(),
            'name' => $this->faker->name,
            'nickname' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'role' => 'member', // member, admin, persona
            'expires_at' => now()->addDays(7),
            'state' => BudgetInvitation::STATE_PENDING,
            'budget_id' => Budget::factory(),
            'sender_id' => User::factory(),
        ];
    }

    /**
     * Indicate that the invitation has expired.
     */
    public function expired(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'expires_at' => $this->faker->dateTimeBetween('now-1week', 'now'),
                'state' => BudgetInvitation::STATE_EXPIRED,
            ];
        });
    }

    /**
     * Indicate that the invitation has been accepted.
     */
    public function accepted(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'expires_at' => $this->faker->dateTimeBetween('now-1week', 'now'),
                'state' => BudgetInvitation::STATE_ACCEPTED,
            ];
        });
    }

    /**
     * Indicate that the invitation has been rejected.
     */
    public function rejected(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'expires_at' => $this->faker->dateTimeBetween('now-1week', 'now'),
                'state' => BudgetInvitation::STATE_REJECTED,
            ];
        });
    }

    /**
     * Indicate that the invitation is pending.
     */
    public function pending(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'expires_at' => $this->faker->dateTimeBetween('now', '+1 week'),
                'state' => BudgetInvitation::STATE_PENDING,
            ];
        });
    }
}
