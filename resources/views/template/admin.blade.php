<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>zari</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('assets/style.css')}}">
    <script src="{{ asset('assets/js/main.js') }}" defer></script>
</head>
<body class="bg-[var(--main-bg-color)]">
    <div class="absolute hidden z-10 px-3 py-2 bg-white rounded-2xl transition duration-500" id="urlCopied">
        <p class="font-montserrat">Ссылка скопирована!</p>
    </div>
    
    <div class="flex flex-col justify-between min-h-screen">
        @yield('content')
    </div>
</body>
</html>