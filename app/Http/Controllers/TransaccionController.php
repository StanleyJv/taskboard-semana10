<?php

namespace App\Http\Controllers;

use App\Models\Comercio;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransaccionController extends Controller
{
    public function index()
    {
        return Transaccion::with('comercio')->get();
    }

    public function show(Transaccion $transaccion)
    {
        return $transaccion->load('comercio');
    }

    public function create(Comercio $comercio): View
    {
        return view('transacciones.create', compact('comercio'));
    }

    public function store(Request $request)
    {
        $transaccion = Transaccion::create([
            'comercio_id' => $request->comercio_id,
            'cliente_nombre' => $request->cliente_nombre,
            'monto' => $request->monto,
            'metodo_pago' => 'No especificado',
        ]);

        return redirect()
            ->route('comercios.show', $transaccion->comercio_id)
            ->with('mensaje', 'Transacción registrada con éxito.');
    }
}