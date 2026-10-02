<?php

namespace App\Http\Controllers;

use App\Models\Comercio;

class ComercioController extends Controller
{
    public function index()
    {
        $comercios = Comercio::withCount('transacciones')->get();

        return view('comercios.index', [
            'comercios' => $comercios,
        ]);
    }

    public function show(Comercio $comercio)
    {
        $comercio->load('transacciones');

        return view('comercios.show', [
            'comercio' => $comercio,
        ]);
    }
}