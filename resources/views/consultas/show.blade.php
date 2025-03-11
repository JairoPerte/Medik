@extends('layouts.app')

@section('content')
<x-app-layout>
    <h1>Detalles de la Consulta</h1>
    <p><strong>ID:</strong> {{ $consulta->id }}</p>
    <p><strong>Número:</strong> {{ $consulta->num }}</p>
    <p><strong>Tipo de Sala:</strong> {{ $consulta->tipoSala }}</p>
    <p><strong>Centro Médico:</strong> {{ $consulta->centroMedico->nombre }}</p>

    <a href="{{ route('consultas.index') }}">Volver a la lista</a>
    <a href="{{ route('consultas.edit', $consulta->id) }}">Editar</a>
    
    <form action="{{ route('consultas.destroy', $consulta->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</button>
    </form>
</x-app-layout>
@endsection
