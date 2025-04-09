<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

    <div class="container py-4">

        {{-- Menú de navegación --}}
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('buscar_qr') ? 'active' : '' }}" href="{{ route('buscar.qr') }}">📷 QR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('buscar_M') ? 'active' : '' }}" href="{{ url('/buscar_M') }}">✍️ Manual</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('agregar') ? 'active' : '' }}" href="{{ route('producto.agregar') }}">➕ Agregar</a>
            </li>
        </ul>

        <h2 class="mb-4 text-center">🔍 Buscar producto</h2>

        <div class="mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Escribe para buscar...">
        </div>

        {{-- ALERTAS --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Codigo de barra</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Imagen</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="productTable">
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product[0] ?? '' }}</td>
                            <td>{{ $product[1] ?? '' }}</td>
                            <td>{{ $product[2] ?? '' }}</td>
                            <td>
                                @if(!empty($product[3]))
                                    <img src="{{ $product[3] }}" alt="Imagen" width="80">
                                @else
                                    <span class="text-muted">Sin imagen</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('productos.editar', ['codigo' => $product[0]]) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                                <a href="{{ route('producto.imagen', ['codigo' => $product[0]]) }}" class="btn btn-warning btn-sm">🖼 Imagen</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const tableRows = document.querySelectorAll('#productTable tr');

        searchInput.addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();

            tableRows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchValue) ? '' : 'none';
            });
        });
    </script>

</body>
</html>
