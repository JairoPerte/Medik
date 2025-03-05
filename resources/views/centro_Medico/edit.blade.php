@extends('layouts.app')

@section('content')
    <h1>Editar Centro Médico</h1>
    <form action="{{ route('centros.update', $centro->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $centro->nombre }}" required>

        <label>Localidad:</label>
        <input type="text" name="localidad" value="{{ $centro->localidad }}" required>

        <label>Calle:</label>
        <input type="text" name="calle" value="{{ $centro->calle }}" required>

        <button type="submit">Actualizar</button>
    </form>
@endsection
