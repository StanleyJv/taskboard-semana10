@props(['totalTransacciones'])

@if ($totalTransacciones === 0)
    <span>Sin actividad</span>
@else
    <span>Activo</span>
@endif