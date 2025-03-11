<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Consultas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <!-- Botón para Crear Nueva Consulta -->
                <div class="mb-6 flex justify-between">
                    <h1 class="text-2xl font-bold">Consultas Registradas</h1>
                    <a href="{{ route('consultas.create') }}" 
                       class="bg-gray-500 hover:bg-gray-700 text-gray font-bold py-2 px-4 rounded">
                        Nueva Consulta
                    </a>
                </div>

                <!-- Tabla de Consultas -->
                <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">Número</th>
                            <th class="border px-4 py-2">Tipo de Sala</th>
                            <th class="border px-4 py-2">Centro Médico</th>
                            <th class="border px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultas as $consulta)
                            <tr>
                                <td class="border px-4 py-2">{{ $consulta->id }}</td>
                                <td class="border px-4 py-2">{{ $consulta->num }}</td>
                                <td class="border px-4 py-2">{{ $consulta->tipoSala }}</td>
                                <td class="border px-4 py-2">{{ $consulta->centro_medico?->nombre ?? 'Sin asignar' }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('consultas.show', $consulta->id) }}" class="text-green-500">Ver</a>
                                    <a href="{{ route('consultas.edit', $consulta->id) }}" class="text-green-500 ml-2">Editar</a>
                                    <form action="{{ route('consultas.destroy', $consulta->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar?')" 
                                                class="text-red-500 ml-2">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
