<?php

namespace App\Domains\Shared\Enums;

enum Frequency: string
{
    case DAILY = 'Daily';
    case WEEKLY = 'Weekly';
    case MONTHLY = 'Monthly';
    case TWICE_A_MONTH = 'Twice a Month';
    case QUARTERLY = 'Quarterly';
    case ANNUAL = 'Annually';
    case ONE_TIME = 'One-Time';
    case IRREGULAR = 'Irregular';

    public function numberOfOccurancesInWeek()
    {
        switch ($this->value) {
            case 'Daily':
                return 7;
            case 'Weekly':
                return 1;
            case 'Monthly':
                return 0;
            case 'Twice a Month':
                return 0;
            case 'Quarterly':
                return 0;
            case 'Annually':
                return 0;
            case 'One-Time':
                return 0;
            case 'Irregular':
                return 0;
        }
    }

    public function numberOfOccurancesInMonth(): int
    {
        switch ($this->value) {
            case 'Daily':
                return 30; // average number of days in a month
            case 'Weekly':
                return 4; // average number of weeks in a month
            case 'Monthly':
                return 1;
            case 'Twice a Month':
                return 2;
            case 'Quarterly':
                return 0;
            case 'Annually':
                return 0;
            case 'One-Time':
                return 0;
            case 'Irregular':
                return 0;
        }
    }

    public function numberOfOccurancesInQuarter(): int
    {
        switch ($this->value) {
            case 'Daily':
                return 90; // average number of days in a quarter
            case 'Weekly':
                return 14; // average number of weeks in a quarter
            case 'Monthly':
                return 3;
            case 'Twice a Month':
                return 6;
            case 'Quarterly':
                return 1;
            case 'Annually':
                return 0;
            case 'One-Time':
                return 0;
            case 'Irregular':
                return 0;
        }
    }

    public function numberOfOccurancesInYear(): int
    {
        switch ($this->value) {
            case 'Daily':
                return 365; // average number of days in a year
            case 'Weekly':
                return 52; // average number of weeks in a year
            case 'Monthly':
                return 12;
            case 'Twice a Month':
                return 24;
            case 'Quarterly':
                return 4;
            case 'Annually':
                return 1;
            case 'One-Time':
                return 0;
            case 'Irregular':
                return 0;
        }
    }
}
