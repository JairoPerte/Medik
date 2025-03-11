<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Lista de Doctores
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Botón para Crear Nuevo Doctor -->
                <div class="mb-6 flex justify-between">
                    <h1 class="text-2xl font-bold">Doctores Registrados</h1>
                    <a href="{{ route('doctores.create') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-gray font-bold py-2 px-4 rounded">
                        Nuevo Doctor
                    </a>
                </div>

                <!-- Tabla de Doctores -->
                <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border px-4 py-2">ID</th>
                            <th class="border px-4 py-2">NIF</th>
                            <th class="border px-4 py-2">Nombre</th>
                            <th class="border px-4 py-2">Apellido</th>
                            <th class="border px-4 py-2">Edad</th>
                            <th class="border px-4 py-2">Teléfono</th>
                            <th class="border px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctores as $doctor)
                            <tr>
                                <td class="border px-4 py-2">{{ $doctor->id }}</td>
                                <td class="border px-4 py-2">{{ $doctor->nif }}</td>
                                <td class="border px-4 py-2">{{ $doctor->nombre }}</td>
                                <td class="border px-4 py-2">{{ $doctor->apellido }}</td>
                                <td class="border px-4 py-2">{{ $doctor->edad }}</td>
                                <td class="border px-4 py-2">{{ $doctor->numtel }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('doctores.show', $doctor->id) }}" class="text-green-500">Ver</a>
                                    <a href="{{ route('doctores.edit', $doctor->id) }}"
                                        class="text-green-500 ml-2">Editar</a>
                                    <form action="{{ route('doctores.destroy', $doctor->id) }}" method="POST"
                                        style="display:inline;">
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
