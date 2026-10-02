<?php

namespace App\Http\Controllers;

use App\Models\Comercio;

class ComercioController extends Controller
{
    public function index()
    {
        return Comercio::with('transacciones')->get();
    }

    public function show(Comercio $comercio)
    {
        return $comercio->load('transacciones');
    }
}