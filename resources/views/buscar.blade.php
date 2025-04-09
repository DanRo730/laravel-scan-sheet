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
            <a class="nav-link" href="{{ route('buscar.qr') }}">📷 QR</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('/buscar_M') }}">✍️ Manual</a>
            </li>
            <li class="nav-item {{ request()->is('agregar') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('producto.agregar') }}">Agregar</a>
            </li>
        </ul>


        <div class="container text-center">
            <h2>Escanea el Código de Barras</h2>

            <div id="reader"></div>
            <div id="resultado" class="mt-4"></div>
        </div>

        <script>
            function mostrarProducto(producto) {
                let html = `
                    <h3>${producto.nombre}</h3>
                    <p><strong>Precio:</strong> $${producto.precio}</p>
                    ${producto.imagen ? `<img src="${producto.imagen}" alt="Imagen">` : ''}
                `;
                document.getElementById('resultado').innerHTML = html;
            }

            function buscarProducto(codigo) {
                fetch(`/buscar-producto?codigo=${codigo}`)
                    .then(res => res.json())
                    .then(data => mostrarProducto(data))
                    .catch(() => {
                        document.getElementById('resultado').innerHTML = `<p>Producto no encontrado</p>`;
                    });
            }

            const scanner = new Html5Qrcode("reader");
            scanner.start(
                { facingMode: "environment" },
                { fps: 10, qrbox: 250 },
                (decodedText) => {
                    scanner.stop();
                    buscarProducto(decodedText);
                }
            ).catch(err => {
                console.error(err);
            });
        </script>

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
    </div>

</body>
</html>
