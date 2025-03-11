@extends('layouts.app')

@section('content')
<x-app-layout>
    <h1>Crear Nuevo Centro Médico</h1>
    <form action="{{ route('centros.store') }}" method="POST">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Localidad:</label>
        <input type="text" name="localidad" required>

        <label>Calle:</label>
        <input type="text" name="calle" required>

        <button type="submit">Guardar</button>
    </form>
</x-app-layout>
@endsection
