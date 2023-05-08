<!DOCTYPE html>
<html lang="en" @stack('html::tag')>
<head>
    @stack('head::start')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    @stack('head::end')
</head>
<body @stack('body::tag')>
    @stack('body::start')
    
    @yield('body')

    @stack('body::end')
</body>
</html>