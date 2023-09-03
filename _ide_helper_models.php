<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Account
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property AccountType|null $type
 * @property int|null $subtype_id
 * @property Currency|null $currency
 * @property Frequency|null $frequency
 * @property int|null $institution_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $color
 * @property array|null $meta
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Budget $budget
 * @property-read Institute|null $institution
 * @property-read User|null $user
 * @method static Builder|Account active()
 * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
 * @method static Builder|Account newModelQuery()
 * @method static Builder|Account newQuery()
 * @method static Builder|Account onlyTrashed()
 * @method static Builder|Account query()
 * @method static Builder|Account whereActive($value)
 * @method static Builder|Account whereBudgetId($value)
 * @method static Builder|Account whereColor($value)
 * @method static Builder|Account whereCreatedAt($value)
 * @method static Builder|Account whereCurrency($value)
 * @method static Builder|Account whereDeletedAt($value)
 * @method static Builder|Account whereDescription($value)
 * @method static Builder|Account whereFrequency($value)
 * @method static Builder|Account whereId($value)
 * @method static Builder|Account whereInstitutionId($value)
 * @method static Builder|Account whereMeta($value)
 * @method static Builder|Account whereName($value)
 * @method static Builder|Account whereSubtypeId($value)
 * @method static Builder|Account whereType($value)
 * @method static Builder|Account whereUlid($value)
 * @method static Builder|Account whereUpdatedAt($value)
 * @method static Builder|Account whereUrl($value)
 * @method static Builder|Account whereUserId($value)
 * @method static Builder|Account whereUsername($value)
 * @method static Builder|Account withTrashed()
 * @method static Builder|Account withoutTrashed()
 * @mixin \Eloquent
 */
	class Account extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AssetAccount
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property AccountType|null $type
 * @property int|null $subtype_id
 * @property \App\Enums\Currency|null $currency
 * @property \App\Enums\Frequency|null $frequency
 * @property int|null $institution_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $color
 * @property array|null $meta
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Budget $budget
 * @property-read \App\Models\Institute|null $institution
 * @property-read \App\Models\AssetAccountType|null $subtype
 * @property-read \App\Models\User|null $user
 * @method static Builder|Account active()
 * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereSubtypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccount withoutTrashed()
 * @mixin \Eloquent
 */
	class AssetAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\AssetAccountType
 *
 * @property int $id
 * @property string $ulid
 * @property string $name
 * @property string $abbr
 * @property string|null $tagline
 * @property string|null $description
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AssetAccountTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType query()
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereAbbr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AssetAccountType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class AssetAccountType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Budget
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BudgetInvitation> $invitations
 * @property-read int|null $invitations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, User> $members
 * @property-read int|null $members_count
 * @property-read User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BudgetInvitation> $pendingInvitations
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
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Account> $accounts
 * @property-read int|null $accounts_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Account> $activeAccounts
 * @property-read int|null $active_accounts_count
 * @property-read \App\Models\BudgetLedger|null $ledger
 * @property-read \Illuminate\Database\Eloquent\Collection<int, AssetAccount> $assetAccounts
 * @property-read int|null $asset_accounts_count
 * @mixin \Eloquent
 */
	class Budget extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BudgetInvitation
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
 * @property-read \App\Models\Budget|null $budget
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
 * @property string|null $role
 * @method static Builder|BudgetInvitation pending()
 * @method static Builder|BudgetInvitation whereRole($value)
 * @mixin \Eloquent
 */
	class BudgetInvitation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BudgetLedger
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Budget $budget
 * @method static \Database\Factories\BudgetLedgerFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger query()
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BudgetLedger whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Transaction> $transactions
 * @property-read int|null $transactions_count
 * @mixin \Eloquent
 */
	class BudgetLedger extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Income
 *
 * @property int $id
 * @property string $ulid
 * @property int $budget_id
 * @property int|null $user_id
 * @property string $name
 * @property string|null $description
 * @property AccountType|null $type
 * @property int|null $subtype_id
 * @property \App\Enums\Currency|null $currency
 * @property \App\Enums\Frequency|null $frequency
 * @property int|null $institution_id
 * @property string|null $url
 * @property string|null $username
 * @property string|null $color
 * @property array|null $meta
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncomeDeduction> $activeDeductions
 * @property-read int|null $active_deductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncomeTax> $activeTaxes
 * @property-read int|null $active_taxes_count
 * @property-read \App\Models\Budget $budget
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncomeDeduction> $deductions
 * @property-read int|null $deductions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncomeEntitlement> $entitlements
 * @property-read int|null $entitlements_count
 * @property-read \App\Models\Institute|null $institution
 * @property-read IncomeType|null $subtype
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncomeTax> $taxes
 * @property-read int|null $taxes_count
 * @property-read \App\Models\User|null $user
 * @method static Builder|Account active()
 * @method static \Database\Factories\AccountFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Income newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Income onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income query()
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereBudgetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereInstitutionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereMeta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereSubtypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Income withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Income withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\IncomeEntitlement> $activeEntitlements
 * @property-read int|null $active_entitlements_count
 * @method static \Illuminate\Database\Eloquent\Builder|Income whereLedgerId($value)
 * @mixin \Eloquent
 */
	class Income extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\IncomeType
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

namespace App\Models{
/**
 * App\Models\Institute
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
 * @mixin \Eloquent
 */
	class Institute extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property string $ulid
 * @property int $ledger_id
 * @property int $from_account_id
 * @property int $to_account_id
 * @property string|null $type
 * @property int $amount
 * @property string $currency
 * @property string|null $title
 * @property string|null $description
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read BudgetLedger $ledger
 * @method static \Database\Factories\TransactionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereFromAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereLedgerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereToAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUlid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @property string $transactionable_type
 * @property int $transactionable_id
 * @property-read \App\Models\Account $fromAccount
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTransactionableType($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $toAccount
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
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
 * @property bool $finished_onboarding
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFinishedOnboarding($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent implements \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

