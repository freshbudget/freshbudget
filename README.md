# Fresh Budget 

A family-friendly way to manage your money and stay on top of your budget.

## Features

### Open-Source

Because the codebase for Fresh Budget is open-source, you can see exactly how your infomation is being used. Additionally, you could even contribute and help shape the platform.

## Local Installation

#### Requirements
- Standard [Laravel Requirments](https://laravel.com/docs/10.x/deployment#server-requirements)
- Composer 2+
- PHP 8+
- MySQL 8+
- Node (if working on frontend assets)

#### Clone repo

```bash
git clone https://github.com/freshbudget/freshbudget.git freshbudget
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

- `freshbudget`
- `freshbudgettest` (for tests, optional change database name in `.env.testing` if required)

#### Copy `.env.example` to `.env`

```bash
cp .env.example .env
```

#### Generate Application Key

```bash
php artisan key:generate
```

#### Migrate Database

```bash
php artisan migrate
```

#### Add subdomains to etc\hosts file

We are currently using subdomains for the authentication and application routes. You should configure your local `etc\hosts` file to point `api.domain.test`, `app.domain.test` and `domain.test` to this application. You can also reconfigure this behavior by modifiying the `.env` file.

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

# Deployment Script Considerations

```bash
php artisan icons:cache
```