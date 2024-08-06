<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    @vite('resources/css/app.css')
</head>

<body>
    <h1 class="text-lg text-gray-500 text-center mt-4">Laravel is running</h1>
    <p class="text-gray-400 text-center">Version: {{ app()->version() }}</p>
    <p class="text-gray-400 text-center">PHP: {{ phpversion() }}</p>
</body>

</html>