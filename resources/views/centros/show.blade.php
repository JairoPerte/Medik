@extends('layouts.app')

@section('content')
    <h1>Detalles del Centro Médico</h1>
    <p><strong>ID:</strong> {{ $centroMedico->id }}</p>
    <p><strong>Nombre:</strong> {{ $centroMedico->nombre }}</p>
    <p><strong>Localidad:</strong> {{ $centroMedico->localidad }}</p>
    <p><strong>Calle:</strong> {{ $centroMedico->calle }}</p>

    <a href="{{ route('centros.index') }}">Volver a la lista</a>
    <a href="{{ route('centros.edit', $centroMedico->id) }}">Editar</a>
    
    <form action="{{ route('centros.destroy', $centroMedico->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</button>
    </form>
@endsection
