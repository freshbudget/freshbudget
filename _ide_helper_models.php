<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Domains\Accounts\Models{
/**
 * App\Domains\Accounts\Models\Account
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property \App\Domains\Shared\Enums\AccountType|null $type
 * @property string|null $subtype
 * @property \App\Domains\Shared\Enums\Currency|null $currency
 * @property \App\Domains\Shared\Enums\Frequency|null $frequency
 * @property int|null $institution_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $color
 * @property array|null $meta
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Budgets\Models\Budget $budget
 * @property-read \App\Domains\Shared\Models\Institute|null $institute
 * @property-read \App\Domains\Users\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Account active()
 * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Account newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Account onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Account query()
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereSubtype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Account withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Account withoutTrashed()
 */
	class Account extends \Eloquent {}
}

namespace App\Domains\Budgets\Models{
/**
 * App\Domains\Budgets\Models\Budget
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string|null $currency
 * @property int $owner_id
 * @property bool $personal
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Income> $activeIncomes
 * @property-read int|null $active_incomes_count
 * @property-read User|null $deleter
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Income> $incomes
 * @property-read int|null $incomes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Budgets\Models\BudgetInvitation> $invitations
 * @property-read int|null $invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $members
 * @property-read int|null $members_count
 * @property-read User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Budgets\Models\BudgetInvitation> $pendingInvitations
 * @property-read int|null $pending_invitations_count
 * @method static \Database\Factories\BudgetFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget query()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget wherePersonal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Budget withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Budget withoutTrashed()
 * @mixin \Eloquent
 */
	class Budget extends \Eloquent {}
}

namespace App\Domains\Budgets\Models{
/**
 * App\Domains\Budgets\Models\BudgetInvitation
 *
 * @property int $id
 * @property string $ulid
 * @property string $token
 * @property string $name
 * @property string|null $nickname
 * @property string|null $email
 * @property Carbon $expires_at
 * @property string $state
 * @property int|null $budget_id
 * @property int|null $sender_id
 * @property Carbon|null $sent_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read \App\Domains\Budgets\Models\Budget|null $budget
 * @property-read User|null $sender
 * @method static \Database\Factories\BudgetInvitationFactory factory($count = null, $state = [])
 * @method static Builder|BudgetInvitation newModelQuery()
 * @method static Builder|BudgetInvitation newQuery()
 * @method static Builder|BudgetInvitation query()
 * @method static Builder|BudgetInvitation whereBudgetId($value)
 * @method static Builder|BudgetInvitation whereCreatedAt($value)
 * @method static Builder|BudgetInvitation whereEmail($value)
 * @method static Builder|BudgetInvitation whereExpiresAt($value)
 * @method static Builder|BudgetInvitation whereId($value)
 * @method static Builder|BudgetInvitation whereName($value)
 * @method static Builder|BudgetInvitation whereNickname($value)
 * @method static Builder|BudgetInvitation whereSenderId($value)
 * @method static Builder|BudgetInvitation whereSentAt($value)
 * @method static Builder|BudgetInvitation whereState($value)
 * @method static Builder|BudgetInvitation whereToken($value)
 * @method static Builder|BudgetInvitation whereUlid($value)
 * @method static Builder|BudgetInvitation whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $role
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetInvitation pending()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetInvitation whereRole($value)
 */
	class BudgetInvitation extends \Eloquent {}
}

namespace App\Domains\Budgets\Models{
/**
 * App\Domains\Budgets\Models\BudgetStatistic
 *
 * @property int $id
 * @property int $budget_id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $type
 * @property int|null $value
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Budgets\Models\Budget $budget
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic decrements()
 * @method static \Database\Factories\BudgetStatisticFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic groupByPeriod(string $period)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic increments()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetStatistic whereValue($value)
 * @mixin \Eloquent
 */
	class BudgetStatistic extends \Eloquent {}
}

namespace App\Domains\Incomes\Models{
/**
 * App\Domains\Incomes\Models\Income
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property int|null $type_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $currency
 * @property Frequency|null $frequency
 * @property array|null $meta
 * @property bool $active
 * @property int|null $estimated_entitlements_per_period
 * @property int|null $estimated_taxes_per_period
 * @property int|null $estimated_deductions_per_period
 * @property int|null $estimated_net_per_period
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeDeduction> $activeDeductions
 * @property-read int|null $active_deductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeTax> $activeTaxes
 * @property-read int|null $active_taxes_count
 * @property-read Budget $budget
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeDeduction> $deductions
 * @property-read int|null $deductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeEntitlement> $entitlements
 * @property-read int|null $entitlements_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeStatistic> $statistics
 * @property-read int|null $statistics_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Domains\Incomes\Models\IncomeTax> $taxes
 * @property-read int|null $taxes_count
 * @property-read \App\Domains\Incomes\Models\IncomeType|null $type
 * @property-read User|null $user
 * @method static Builder|Income active()
 * @method static \Database\Factories\IncomeFactory factory($count = null, $state = [])
 * @method static Builder|Income newModelQuery()
 * @method static Builder|Income newQuery()
 * @method static Builder|Income onlyTrashed()
 * @method static Builder|Income query()
 * @method static Builder|Income whereActive($value)
 * @method static Builder|Income whereBudgetId($value)
 * @method static Builder|Income whereCreatedAt($value)
 * @method static Builder|Income whereCurrency($value)
 * @method static Builder|Income whereDeletedAt($value)
 * @method static Builder|Income whereDescription($value)
 * @method static Builder|Income whereEstimatedDeductionsPerPeriod($value)
 * @method static Builder|Income whereEstimatedEntitlementsPerPeriod($value)
 * @method static Builder|Income whereEstimatedNetPerPeriod($value)
 * @method static Builder|Income whereEstimatedTaxesPerPeriod($value)
 * @method static Builder|Income whereFrequency($value)
 * @method static Builder|Income whereId($value)
 * @method static Builder|Income whereMeta($value)
 * @method static Builder|Income whereName($value)
 * @method static Builder|Income whereTypeId($value)
 * @method static Builder|Income whereUlid($value)
 * @method static Builder|Income whereUpdatedAt($value)
 * @method static Builder|Income whereUrl($value)
 * @method static Builder|Income whereUserId($value)
 * @method static Builder|Income whereUsername($value)
 * @method static Builder|Income withTrashed()
 * @method static Builder|Income withoutTrashed()
 * @mixin \Eloquent
 */
	class Income extends \Eloquent {}
}

namespace App\Domains\Incomes\Models{
/**
 * App\Domains\Incomes\Models\IncomeDeduction
 *
 * @property int $id
 * @property string $ulid
 * @property int $income_id
 * @property string $name
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property int|null $previous_id
 * @property string|null $change_reason
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Incomes\Models\Income $income
 * @property-read IncomeDeduction|null $previous
 * @method static Builder|IncomeDeduction active()
 * @method static \Database\Factories\IncomeDeductionFactory factory($count = null, $state = [])
 * @method static Builder|IncomeDeduction newModelQuery()
 * @method static Builder|IncomeDeduction newQuery()
 * @method static Builder|IncomeDeduction query()
 * @method static Builder|IncomeDeduction whereActive($value)
 * @method static Builder|IncomeDeduction whereAmount($value)
 * @method static Builder|IncomeDeduction whereChangeReason($value)
 * @method static Builder|IncomeDeduction whereCreatedAt($value)
 * @method static Builder|IncomeDeduction whereEndDate($value)
 * @method static Builder|IncomeDeduction whereId($value)
 * @method static Builder|IncomeDeduction whereIncomeId($value)
 * @method static Builder|IncomeDeduction whereName($value)
 * @method static Builder|IncomeDeduction wherePreviousId($value)
 * @method static Builder|IncomeDeduction whereStartDate($value)
 * @method static Builder|IncomeDeduction whereUlid($value)
 * @method static Builder|IncomeDeduction whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IncomeDeduction extends \Eloquent {}
}

namespace App\Domains\Incomes\Models{
/**
 * App\Domains\Incomes\Models\IncomeEntitlement
 *
 * @property int $id
 * @property string $ulid
 * @property int $income_id
 * @property string $name
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Incomes\Models\Income $income
 * @property-write mixed $reason
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Mpociot\Versionable\Version> $versions
 * @property-read int|null $versions_count
 * @method static \Database\Factories\IncomeEntitlementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntitlement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IncomeEntitlement extends \Eloquent {}
}

namespace App\Domains\Incomes\Models{
/**
 * App\Domains\Incomes\Models\IncomeEntry
 *
 * @property int $id
 * @property string $ulid
 * @property int $income_id
 * @property \Illuminate\Support\Carbon $date
 * @property array $entitlements
 * @property array $taxes
 * @property array $deductions
 * @property int $entitlements_total
 * @property int $taxes_total
 * @property int $deductions_total
 * @property int $net_income
 * @property string|null $notes
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Incomes\Models\Income $income
 * @method static \Database\Factories\IncomeEntryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereDeductions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereDeductionsTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereEntitlements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereEntitlementsTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereNetIncome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereTaxes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereTaxesTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeEntry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IncomeEntry extends \Eloquent {}
}

namespace App\Domains\Incomes\Models{
/**
 * App\Domains\Incomes\Models\IncomeNew
 *
 * @property \App\Domains\Shared\Enums\AccountType $type
 * @property \App\Domains\Shared\Enums\Currency $currency
 * @property \App\Domains\Shared\Enums\Frequency $frequency
 * @property-read \App\Domains\Budgets\Models\Budget $budget
 * @property-read \App\Domains\Shared\Models\Institute $institute
 * @property-read \App\Domains\Users\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Account active()
 * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeNew newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeNew newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeNew onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeNew query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeNew withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeNew withoutTrashed()
 */
	class IncomeNew extends \Eloquent {}
}

namespace App\Domains\Incomes\Models{
/**
 * App\Domains\Incomes\Models\IncomeStatistic
 *
 * @property int $id
 * @property int $income_id
 * @property string|null $name
 * @property string|null $type
 * @property int|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Incomes\Models\Income $income
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic decrements()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic groupByPeriod(string $period)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic increments()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeStatistic whereValue($value)
 * @mixin \Eloquent
 */
	class IncomeStatistic extends \Eloquent {}
}

namespace App\Domains\Incomes\Models{
/**
 * App\Domains\Incomes\Models\IncomeTax
 *
 * @property int $id
 * @property string $ulid
 * @property int $income_id
 * @property string $name
 * @property int $amount
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property int|null $previous_id
 * @property string|null $change_reason
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Domains\Incomes\Models\Income $income
 * @property-read IncomeTax|null $previous
 * @method static \Database\Factories\IncomeTaxFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereChangeReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereIncomeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax wherePreviousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeTax whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IncomeTax extends \Eloquent {}
}

namespace App\Domains\Incomes\Models{
/**
 * App\Domains\Incomes\Models\IncomeType
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string $abbr
 * @property string|null $tagline
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\IncomeTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType query()
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|IncomeType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IncomeType extends \Eloquent {}
}

namespace App\Domains\Shared\Models{
/**
 * App\Domains\Shared\Models\Institute
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string $abbr
 * @property string|null $color
 * @property string|null $logo
 * @property string|null $description
 * @property string|null $general_url
 * @property string|null $auth_url
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Institute active()
 * @method static \Database\Factories\InstituteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Institute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute query()
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereAuthUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereGeneralUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Institute whereUpdatedAt($value)
 */
	class Institute extends \Eloquent {}
}

namespace App\Domains\Users\Models{
/**
 * App\Domains\Users\Models\User
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string|null $nickname
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $password
 * @property bool $two_factor_enabled
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property \Illuminate\Support\Carbon|null $two_factor_confirmed_at
 * @property int|null $current_budget_id
 * @property string|null $registration_source
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Budget|null $currentBudget
 * @property-read string $avatar
 * @property-read string $display_name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Budget> $joinedBudgets
 * @property-read int|null $joined_budgets_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Budget> $ownedBudgets
 * @property-read int|null $owned_budgets_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRegistrationSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $finished_onboarding
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFinishedOnboarding($value)
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

