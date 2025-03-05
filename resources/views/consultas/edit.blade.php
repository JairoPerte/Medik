@extends('layouts.app')

@section('content')
    <h1>Editar Consulta</h1>
    <form action="{{ route('consultas.update', $consulta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Número:</label>
        <input type="text" name="num" value="{{ $consulta->num }}" required>

        <label>Tipo de Sala:</label>
        <input type="text" name="tipoSala" value="{{ $consulta->tipoSala }}" required>

        <label>Centro Médico:</label>
        <select name="CentroMedico_idCentroMedico">
            @foreach($centrosMedicos as $centro)
                <option value="{{ $centro->id }}" {{ $consulta->CentroMedico_idCentroMedico == $centro->id ? 'selected' : '' }}>
                    {{ $centro->nombre }}
                </option>
            @endforeach
        </select>

        <button type="submit">Actualizar</button>
    </form>
@endsection
