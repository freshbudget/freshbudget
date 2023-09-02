<?php

namespace App\Domains\Shared\Enums;

enum Currency: string
{
    case USD = 'USD';
    case CAD = 'CAD';
    case EUR = 'EUR';

    public static function all(): array
    {
        return [
            self::USD,
            self::CAD,
            self::EUR,
        ];
    }

    public static function default(): Currency
    {
        return self::USD;
    }

    public static function isValid(string $currency): bool
    {
        return in_array($currency, self::all());
    }

    public static function symbol(string $currency): string
    {
        return match ($currency) {
            self::USD => '$',
            self::CAD => '$',
            self::EUR => '€',
            default => '$',
        };
    }

    public static function forSelectInput(): array
    {
        return [
            self::USD => 'United States Dollar (USD)',
            self::CAD => 'Canadian Dollar (CAD)',
            self::EUR => 'Euro (EUR)',
        ];
    }
}
