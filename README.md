# Fresh Budget 

A family-friendly way to manage your money and stay on top of your budget.

## Requirements
- PHP 8
- MySQL 8

## Local Installation

#### Clone repo

```bash
git clone https://github.com/freshbudget/freshbudget.app.git freshbudget
```

#### Install PHP dependencies

```bash
composer install
```
#### Install frontend dependencies (optional)

```bash
yarn install
```

#### Create databases

- freshbudget
- freshbudgettest (for tests)

#### Generate Application Key

```bash
php artisan key:generate
```

#### Migrate Database

```bash
php artisan migrate
```

## Testing

We use Pest PHP for the test suite, please ensure before pushing changes you confirm there are no breaking changes by running the command below. Additionally, tests for new features are highly encouraged, changes will be considered without tests but it will increase the time to accept / merge.

```bash
php artisan test
```

## Style Guide

We use Laravel Pint to automatically standardize code styling, before pushing changes please run pint using the command below.

```bash
./vendor/bin/pint
```