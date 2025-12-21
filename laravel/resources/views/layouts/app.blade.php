<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Prendas de Natal')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    <div class="container">
        <header>
            <h1>🎄 Prendas de Natal</h1>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

</body>

</html>
