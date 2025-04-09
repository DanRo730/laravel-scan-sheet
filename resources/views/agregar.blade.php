@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4 text-center">📦 Agregar nuevo producto</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('producto.guardar') }}">
        @csrf
        <div class="mb-3">
            <label for="codigo" class="form-label">Código de barras</label>
            <input type="text" id="codigo" name="codigo" class="form-control" required>
        </div>

        {{-- Aquí se agregará el lector --}}
        <div class="mb-3 text-center">
            <div id="reader" style="width: 300px; margin: auto;"></div>
        </div>

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="text" name="precio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">URL de la imagen (opcional)</label>
            <input type="text" name="imagen" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    const scanner = new Html5Qrcode("reader");
    scanner.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: 250
        },
        (decodedText, decodedResult) => {
            document.getElementById('codigo').value = decodedText;
            scanner.stop(); // Opcional: detener escáner después de una lectura
        }
    ).catch(err => {
        console.error(err);
    });
</script>
@endsection
