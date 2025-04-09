<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-4">

            {{-- Menú de navegación --}}
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                <a class="nav-link" href="{{ route('buscar.qr') }}">📷 QR</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/buscar_M') }}">✍️ Manual</a>
                </li>
                <li class="nav-item {{ request()->is('agregar') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('producto.agregar') }}">Agregar</a>
                </li>
            </ul>

        {{-- Contenido de la página --}}
        <div class="container mt-4">
            @yield('content')
        </div>
    </div>

</body>
</html>
