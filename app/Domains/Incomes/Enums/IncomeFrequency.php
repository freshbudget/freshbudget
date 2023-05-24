<?php

namespace App\Domains\Incomes\Enums;

enum IncomeFrequency: string
{
    case DAILY = 'Daily';
    case WEEKLY = 'Weekly';
    case BIWEEKLY = 'Bi-Weekly';
    case MONTHLY = 'Monthly';
    case BIMONTHLY = 'Bi-Monthly';
    case QUARTERLY = 'Quarterly';
    case ANNUAL = 'Annually';
    case ONE_TIME = 'One-Time';
    case IRREGULAR = 'Irregular';
}
