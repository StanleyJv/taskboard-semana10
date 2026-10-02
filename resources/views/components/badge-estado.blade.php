@props(['estado'])

@if ($estado === 'Completada')
    <span>✔ {{ $estado }}</span>

@elseif ($estado === 'Fallida')
    <span>✗ {{ $estado }}</span>

@else
    <span>⏳ {{ $estado }}</span>
@endif