@extends('layouts.app')

@section('content')
    <h1>Lista de Centros Médicos</h1>
    <a href="{{ route('centros.create') }}">Nuevo Centro Médico</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Localidad</th>
            <th>Calle</th>
            <th>Acciones</th>
        </tr>
        @foreach ($centros as $centro)
            <tr>
                <td>{{ $centro->id }}</td>
                <td>{{ $centro->nombre }}</td>
                <td>{{ $centro->localidad }}</td>
                <td>{{ $centro->calle }}</td>
                <td>
                    <a href="{{ route('centros.show', $centro->id) }}">Ver</a>
                    <a href="{{ route('centros.edit', $centro->id) }}">Editar</a>
                    <form action="{{ route('centros.destroy', $centro->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
