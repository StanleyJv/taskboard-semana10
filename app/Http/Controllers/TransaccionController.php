<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;

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
}