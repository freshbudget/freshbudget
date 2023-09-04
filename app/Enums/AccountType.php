<?php

namespace App\Enums;

enum AccountType: string
{
    /*
    |--------------------------------------------------
    | Examples of an asset account:
    | - Cash
    | - Checking account
    | - Savings account
    |--------------------------------------------------
     */
    case ASSET = 'Asset';

    /*
    |--------------------------------------------------
    | Examples of a liability account:
    | - Credit card
    | - Mortgage
    | - Loan
    |--------------------------------------------------
     */
    case LIABILITY = 'Liability';

    /*
    |--------------------------------------------------
    | Examples of an equity account:
    | - Owner's equity
    | - Retained earnings
    |--------------------------------------------------
     */
    case EQUITY = 'Equity';

    /*
    |--------------------------------------------------
    | Examples of a revenue account:
    | - Income
    | - Sales
    |--------------------------------------------------
     */
    case REVENUE = 'Revenue';

    /*
    |--------------------------------------------------
    | Examples of an expense account:
    | - Food
    | - Netflix
    | - Rent
    |--------------------------------------------------
     */
    case EXPENSE = 'Expense';

    public function displayName(): string
    {
        return match ($this) {
            self::ASSET => 'Account',
            self::LIABILITY => 'Expense',
            self::EQUITY => 'Equity',
            self::REVENUE => 'Income',
            self::EXPENSE => 'Expense',
            default => 'Unknown',
        };
    }

    // case ASSET = 'Asset account';
    // case BENEFICIARY = 'Beneficiary account';
    // case CASH = 'Cash account';
    // case CREDITCARD = 'Credit card';
    // case DEBT = 'Debt';
    // case DEFAULT = 'Default account';
    // case EXPENSE = 'Expense account';
    // case IMPORT = 'Import account';
    // case INITIAL_BALANCE = 'Initial balance account';
    // case LIABILITY_CREDIT = 'Liability credit account';
    // case LOAN = 'Loan';
    // case MORTGAGE = 'Mortgage';
    // case RECONCILIATION = 'Reconciliation account';
    // case REVENUE = 'Revenue account';
}
