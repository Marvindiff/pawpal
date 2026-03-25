<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawPal Dashboard</title>
    @vite('resources/css/app.css') <!-- This loads Tailwind -->
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen p-6">
        @yield('content')
    </div>
</body>
</html>