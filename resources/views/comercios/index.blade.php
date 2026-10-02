@extends('layouts.app')

@section('titulo', 'Comercios afiliados')

@section('contenido')

    <h1>Comercios afiliados a la pasarela</h1>

    <ul>
        @forelse ($comercios as $comercio)

            <li>

                <a href="/comercios/{{ $comercio->id }}">
                    {{ $comercio->nombre_comercio }}
                </a>

                — {{ $comercio->rubro }}

                ({{ $comercio->transacciones_count }} transacciones)

                <x-badge-actividad
                    :totalTransacciones="$comercio->transacciones_count"
                />

            </li>

        @empty

            <li>Aún no hay comercios afiliados.</li>

        @endforelse
    </ul>

@endsection