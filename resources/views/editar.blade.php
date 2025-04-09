@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Producto</h2>

    <form action="{{ route('productos.actualizar', $codigo) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Código:</label>
            <input type="text" name="codigo" value="{{ $producto[0] }}" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ $producto[1] }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Precio:</label>
            <input type="text" name="precio" value="{{ $producto[2] }}" class="form-control">
        </div>

        <div class="form-group">
            <label>Imagen (URL):</label>
            <input type="text" name="imagen" value="{{ $producto[3] ?? '' }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
    </form>
</div>
@endsection
