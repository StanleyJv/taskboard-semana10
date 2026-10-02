<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('titulo', 'Pasarela de Pagos — TaskBoard')</title>
</head>
<body>

    <nav>
        Pasarela de Pagos · TaskBoard
    </nav>

    <main>
        @yield('contenido')
    </main>

    <footer>
        &copy; {{ date('Y') }} UPED — Integración de Sistemas
    </footer>

</body>
</html>