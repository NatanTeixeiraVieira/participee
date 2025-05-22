<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <title>@yield('title', 'Minha Aplicação')</title>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        />
    </head>
    <body style="height:100dvh" class="d-flex flex-column">
        {{-- Header --}}
        <header class="bg-dark text-white py-3 mb-4 shadow-sm">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('events.index') }}">Gerenciador de Eventos</a>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto flex gap-4 items-center">
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('myEvents') }}">Meus Eventos</a>
                    </li>
                     <li class="flex items-center">
                        <a href="{{ route('events.index') }}" class="text-white text-decoration-none me-3">Eventos</a>
                    </li>
                    <li class="flex items-center">
                        <a href="{{ route('events.create') }}" class="text-white text-decoration-none">Criar Evento</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-light btn-sm" type="submit">
                                🔒 Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
            <!-- <div class="container d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">🎟️ Sistema de Eventos</h1>
                <nav>
                    <a href="{{ route('events.index') }}" class="text-white text-decoration-none me-3">Eventos</a>
                    <a href="{{ route('events.create') }}" class="text-white text-decoration-none">Criar Evento</a>
                </nav>
            </div> -->
        </header>

        {{-- Conteúdo principal --}}
        <main class="container mb-5 flex-fill">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="bg-light text-center py-3 border-top">
            <div class="container">
                <span class="text-muted">© {{ date('Y') }} Sistema de Eventos. Todos os direitos reservados.</span>
            </div>
        </footer>
    </body>
</html>
