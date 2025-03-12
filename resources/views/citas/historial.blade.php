@extends('layouts.app')

@section('content')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historial de Citas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Citas Pendientes -->
                <h3 class="text-xl font-semibold mb-4">Citas Pendientes</h3>
                @if($citasPendientes->isEmpty())
                    <p>No tienes citas pendientes.</p>
                @else
                    <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Fecha</th>
                                <th class="border px-4 py-2">Centro Médico</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($citasPendientes as $cita)
                                <tr>
                                    <td class="border px-4 py-2">{{ $cita->id }}</td>
                                    <td class="border px-4 py-2">{{ $cita->fecha }}</td>
                                    <td class="border px-4 py-2">{{ $cita->centroMedico->nombre }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('citas.show', $cita->id) }}" class="text-blue-500">Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <!-- Citas Pasadas -->
                <h3 class="text-xl font-semibold mt-6 mb-4">Citas Pasadas</h3>
                @if($citasPasadas->isEmpty())
                    <p>No tienes citas pasadas.</p>
                @else
                    <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                        <thead>
                            <tr class="bg-gray-200">
                                <th class="border px-4 py-2">ID</th>
                                <th class="border px-4 py-2">Fecha</th>
                                <th class="border px-4 py-2">Centro Médico</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($citasPasadas as $cita)
                                <tr>
                                    <td class="border px-4 py-2">{{ $cita->id }}</td>
                                    <td class="border px-4 py-2">{{ $cita->fecha }}</td>
                                    <td class="border px-4 py-2">{{ $cita->centroMedico->nombre }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('citas.show', $cita->id) }}" class="text-blue-500">Ver</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
@endsection
