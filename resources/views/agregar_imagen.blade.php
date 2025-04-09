<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Imagen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    {{-- Menú de navegación --}}
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('buscar.qr') }}">📷 QR</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('/buscar_M') }}">✍️ Manual</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('producto.agregar') }}">➕ Agregar</a>
        </li>
    </ul>

    <h3 class="mb-4 text-center">🖼 Agregar o cambiar imagen</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('producto.actualizar.imagen', $codigo) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Código de producto</label>
            <input type="text" class="form-control" value="{{ $codigo }}" disabled>
        </div>
        <div class="mb-3">
            <label for="imagen" class="form-label">URL de la imagen</label>
            <input type="text" name="imagen" id="imagen" class="form-control" placeholder="https://...">
        </div>
        <button type="submit" class="btn btn-success">💾 Guardar Imagen</button>
        <a href="{{ url('/buscar_M') }}" class="btn btn-secondary">🔙 Volver</a>
    </form>
</div>

</body>
</html>
