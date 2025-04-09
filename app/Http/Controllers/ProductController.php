<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleSheetService;

class ProductController extends Controller
{
    protected $googleSheetService;

    public function __construct(GoogleSheetService $googleSheetService)
    {
        $this->googleSheetService = $googleSheetService;
    }

    public function index()
    {
        $spreadsheetId = '1bTHobohvzuEZeaFv44kNwgFrsYxahg6-rHy1m14Z90U';
        $range = 'Productos!A2:D'; // A2 para saltar la fila de encabezado

        $products = $this->googleSheetService->getSheetData($spreadsheetId, $range);

        return view('buscar_M', compact('products'));
    }

    public function guardar(Request $request)
    {
        $data = $request->only(['codigo', 'nombre', 'precio', 'imagen']); // campos del formulario

        $spreadsheetId = '1bTHobohvzuEZeaFv44kNwgFrsYxahg6-rHy1m14Z90U';
        $range = 'Productos!A2'; // puede seguir agregando filas

        $this->googleSheetService->appendRow($spreadsheetId, $range, [
            $data['codigo'],
            $data['nombre'],
            $data['precio'],
            $data['imagen']
        ]);

        return redirect()->back()->with('success', 'Producto agregado correctamente!');
    }

    public function editar($codigo, GoogleSheetService $sheetService)
{
    $spreadsheetId = '1bTHobohvzuEZeaFv44kNwgFrsYxahg6-rHy1m14Z90U';
    $range = 'Productos!A2:D';
    $productos = $sheetService->getSheetData($spreadsheetId, $range);

    foreach ($productos as $producto) {
        if ($producto[0] === $codigo) {
            return view('editar', ['producto' => $producto, 'codigo' => $codigo]);
        }
    }

    return redirect()->route('buscar.manual')->with('error', 'Producto no encontrado');
}

public function actualizar(Request $request, $codigo, GoogleSheetService $sheetService)
{
    $spreadsheetId = '1bTHobohvzuEZeaFv44kNwgFrsYxahg6-rHy1m14Z90U';
    $range = 'Productos!A2:D';
    $productos = $sheetService->getSheetData($spreadsheetId, $range);

    foreach ($productos as $i => $producto) {
        if ($producto[0] === $codigo) {
            $row = $i + 2; // +2 porque empieza en A2
            $sheetService->updateRow($spreadsheetId, "Productos!A{$row}:D{$row}", [
                $request->codigo,
                $request->nombre,
                $request->precio,
                $request->imagen,
            ]);

            return redirect()->route('buscar.manual')->with('success', 'Producto actualizado');
        }
    }

    return redirect()->route('buscar.manual')->with('error', 'Producto no encontrado');
}

public function formularioImagen($codigo, GoogleSheetService $sheetService)
{
    $spreadsheetId = '1bTHobohvzuEZeaFv44kNwgFrsYxahg6-rHy1m14Z90U';
    $range = 'Productos!A2:D';
    $productos = $sheetService->getSheetData($spreadsheetId, $range);

    foreach ($productos as $producto) {
        if ($producto[0] === $codigo) {
            return view('agregar_imagen', ['codigo' => $codigo]);
        }
    }

    return redirect()->route('buscar.manual')->with('error', 'Producto no encontrado');
}

public function actualizarImagen(Request $request, $codigo, GoogleSheetService $sheetService)
{
    $spreadsheetId = '1bTHobohvzuEZeaFv44kNwgFrsYxahg6-rHy1m14Z90U';
    $range = 'Productos!A2:D';
    $productos = $sheetService->getSheetData($spreadsheetId, $range);

    foreach ($productos as $i => $producto) {
        if ($producto[0] === $codigo) {
            $row = $i + 2;
            $producto[3] = $request->imagen;

            $sheetService->updateRow($spreadsheetId, "Productos!A{$row}:D{$row}", $producto);

            return redirect()->route('buscar.manual')->with('success', 'Imagen actualizada correctamente');
        }
    }

    return redirect()->route('buscar.manual')->with('error', 'Producto no encontrado');
}
public function agregar()
{
    return view('agregar'); // Aquí puedes retornar la vista que desees
}

}
