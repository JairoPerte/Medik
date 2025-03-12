<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalles del Doctor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Detalles del Doctor</h1>

                <div class="mb-4">
                    <p><strong>ID:</strong> {{ $doctor->id }}</p>
                </div>

                <div class="mb-4">
                    <p><strong>NIF:</strong> {{ $doctor->nif }}</p>
                </div>

                <div class="mb-4">
                    <p><strong>Nombre:</strong> {{ $doctor->nombre }}</p>
                </div>

                <div class="mb-4">
                    <p><strong>Apellido:</strong> {{ $doctor->apellido }}</p>
                </div>

                <div class="mb-4">
                    <p><strong>Edad:</strong> {{ $doctor->edad }}</p>
                </div>

                <div class="mb-4">
                    <p><strong>Número de Teléfono:</strong> {{ $doctor->numtel }}</p>
                </div>

                <div class="mt-6 flex gap-4">
                    <a href="{{ route('doctores.index') }}"
                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Volver a la lista
                    </a>

                    <a href="{{ route('doctores.edit', $doctor->id) }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Editar
                    </a>

                    <form action="{{ route('doctores.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar?')"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
