<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @stack('html::tag')>
<head>
    @stack('head::start')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="A family-friendly way to manage your money and stay on top of your financial health.">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    @stack('head::end')
</head>
<body @stack('body::tag') class="antialiased text-gray-900 @stack('body::classes')">
    @stack('body::start')
    
    @yield('body')

    
    @stack('body::end')
</body>
</html>