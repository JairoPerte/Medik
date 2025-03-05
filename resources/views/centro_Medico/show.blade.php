@extends('layouts.app')

@section('content')
    <h1>Detalles del Centro Médico</h1>
    <p><strong>ID:</strong> {{ $centro->id }}</p>
    <p><strong>Nombre:</strong> {{ $centro->nombre }}</p>
    <p><strong>Localidad:</strong> {{ $centro->localidad }}</p>
    <p><strong>Calle:</strong> {{ $centro->calle }}</p>

    <a href="{{ route('centros.index') }}">Volver a la lista</a>
    <a href="{{ route('centros.edit', $centro->id) }}">Editar</a>
    
    <form action="{{ route('centros.destroy', $centro->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</button>
    </form>
@endsection
