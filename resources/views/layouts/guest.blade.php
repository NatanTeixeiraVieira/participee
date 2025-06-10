<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <title>@yield('title', 'Minha Aplicação')</title>
        <meta title="Participee" />
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        />
    </head>
    <body style="height:100dvh" class="d-flex flex-column">
        {{-- Conteúdo principal --}}
        <main class="container mb-5 flex-fill">
            @yield('content')
        </main>
    </body>
</html>
