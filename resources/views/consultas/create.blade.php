@extends('layouts.app')

@section('content')
<x-app-layout>
    <h1>Crear Nueva Consulta</h1>
    <form action="{{ route('consultas.store') }}" method="POST">
        @csrf
        <label>Número:</label>
        <input type="text" name="num" required>

        <label>Tipo de Sala:</label>
        <input type="text" name="tipoSala" required>

        <label>Centro Médico:</label>
        <select name="CentroMedico_idCentroMedico">
            @foreach($centrosMedicos as $centro)
                <option value="{{ $centro->id }}">{{ $centro->nombre }}</option>
            @endforeach
        </select>

        <button type="submit">Guardar</button>
    </form>
</x-app-layout>
@endsection
