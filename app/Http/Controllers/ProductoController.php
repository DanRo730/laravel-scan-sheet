<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleSheetService;

class ProductoController extends Controller
{
    public function buscarQR()
    {
        return view('buscar');
    }

    public function buscarManual()
    {
        return view('buscar_M');
    }

    public function buscarProducto(Request $request)
    {
        $codigo = $request->input('codigo');

        $sheetService = new GoogleSheetService();
        $spreadsheetId = 'TU_SPREADSHEET_ID';
        $range = 'Productos!A2:D';

        $datos = $sheetService->getSheetData($spreadsheetId, $range);

        foreach ($datos as $fila) {
            if (isset($fila[0]) && $fila[0] == $codigo) {
                return response()->json([
                    'codigo' => $fila[0] ?? '',
                    'nombre' => $fila[1] ?? '',
                    'precio' => $fila[2] ?? '',
                    'imagen' => $fila[3] ?? '',
                ]);
            }
        }

        return response()->json(['error' => 'Producto no encontrado'], 404);
    }
}
