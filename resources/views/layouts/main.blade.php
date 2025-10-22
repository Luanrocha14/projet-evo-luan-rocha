<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonte do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- CSS da aplicação -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}?v={{ time() }}">

    <!-- JS da aplicação -->
    <script src="{{ asset('js/scripts.js') }}?v={{ time() }}"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <a href="/" class="navbar-brand">
                <img src="{{ asset('img/hdcevents_logo.svg') }}" alt="HDC Events">
            </a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/" class="nav-link">Eventos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('events.create') }}" class="nav-link">Criar Eventos</a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">Entrar</a>
                </li>
                <li class="nav-item">
                    <a href="/" class="nav-link">Cadastrar</a>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container-fluid">
            <div class="row">
                @if (session('msg'))
                    <p class="msg">{{ session('msg') }}</p>
                @endif
                @yield('content')
            </div>
        </div>
    </main>

    <footer>
        <p>HDC Events &copy; 2020</p>
    </footer>
    <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
</body>

</html>
