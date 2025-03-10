@extends('layouts.app')

@section('content')
    <h1>Editar Centro Médico</h1>
    <form action="{{ route('centros.update', $centroMedico->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ old('nombre', $centroMedico->nombre ?? '') }}" required>

        <label>Localidad:</label>
        <input type="text" name="localidad" value="{{ old('localidad', $centroMedico->localidad ?? '') }}" required>

        <label>Calle:</label>
        <input type="text" name="calle" value="{{ old('calle', $centroMedico->calle ?? '') }}" required>

        <button type="submit">Actualizar</button>
    </form>
@endsection
