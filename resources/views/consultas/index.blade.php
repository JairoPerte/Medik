@extends('layouts.app')

@section('content')
    <h1>Lista de Consultas</h1>
    <a href="{{ route('consultas.create') }}">Nueva Consulta</a>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Número</th>
            <th>Tipo de Sala</th>
            <th>Centro Médico</th>
            <th>Acciones</th>
        </tr>
        @foreach ($consultas as $consulta)
            <tr>
                <td>{{ $consulta->id }}</td>
                <td>{{ $consulta->num }}</td>
                <td>{{ $consulta->tipoSala }}</td>
                <td>{{ $consulta->centroMedico->nombre }}</td>
                <td>
                    <a href="{{ route('consultas.show', $consulta->id) }}">Ver</a>
                    <a href="{{ route('consultas.edit', $consulta->id) }}">Editar</a>
                    <form action="{{ route('consultas.destroy', $consulta->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
