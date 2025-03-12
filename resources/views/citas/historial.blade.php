<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Historial de Citas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Citas Pendientes -->
                <h3 class="text-xl font-semibold mb-4 text-white">Citas Pendientes</h3>
                @if($citasPendientes->isEmpty())
                    <p class="text-white">No tienes citas pendientes.</p>
                @else
                    <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                        <thead>
                            <tr class="bg-gray-500">
                                <th class="border px-4 py-2 text-white">ID</th>
                                <th class="border px-4 py-2 text-white">Fecha</th>
                                <th class="border px-4 py-2 text-white">Centro Médico</th>
                                <th class="border px-4 py-2 text-white">Consulta</th>
                                <th class="border px-4 py-2 text-white">Doctor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($citasPendientes as $cita)
                                <tr>
                                    <td class="border px-4 py-2 text-white">{{ $cita->id }}</td>
                                    <td class="border px-4 py-2 text-white">{{ $cita->fecha_hora }}</td>
                                    <td class="border px-4 py-2 text-white">
                                        {{ $cita->centroMedico ? $cita->centroMedico->nombre : 'Centro no asignado' }}
                                    </td>
                                    <td class="border px-4 py-2 text-white">{{ $cita->consulta ? $cita->consulta->num : 'Consulta no asignada' }}</td>
                                    <td class="border px-4 py-2 text-white">
                                        {{ $cita->doctor ? $cita->doctor->nombre : 'Doctor no asignado' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <!-- Citas Pasadas -->
                <h3 class="text-xl font-semibold mt-6 mb-4 text-white">Citas Pasadas</h3>
                @if($citasPasadas->isEmpty())
                    <p class="text-white">No tienes citas pasadas.</p>
                @else
                    <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                        <thead>
                            <tr class="bg-gray-500">
                                <th class="border px-4 py-2 text-white">ID</th>
                                <th class="border px-4 py-2 text-white">Fecha</th>
                                <th class="border px-4 py-2 text-white">Centro Médico</th>
                                <th class="border px-4 py-2 text-white">Consulta</th>
                                <th class="border px-4 py-2 text-white">Doctor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($citasPasadas as $cita)
                                <tr>
                                    <td class="border px-4 py-2 text-white">{{ $cita->id }}</td>
                                    <td class="border px-4 py-2 text-white">{{ $cita->fecha_hora }}</td>
                                    <td class="border px-4 py-2 text-white">
                                        {{ $cita->centroMedico ? $cita->centroMedico->nombre : 'Centro no asignado' }}
                                    </td>
                                    <td class="border px-4 py-2 text-white">{{ $cita->consulta ? $cita->consulta->num : 'Consulta no asignada' }}</td>
                                    <td class="border px-4 py-2 text-white">
                                        {{ $cita->doctor ? $cita->doctor->nombre : 'Doctor no asignado' }}
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
