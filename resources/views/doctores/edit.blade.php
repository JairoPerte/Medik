<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Doctor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Editar Doctor</h1>

                @if ($errors->any())
                    <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                        <strong>Por favor, corrige los siguientes errores:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('doctores.update', $doctor->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- NIF -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">NIF:</label>
                        <input type="text" name="nif" value="{{ old('nif', $doctor->nif) }}" maxlength="10"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Nombre -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nombre:</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $doctor->nombre) }}" maxlength="40"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Apellido -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Apellido:</label>
                        <input type="text" name="apellido" value="{{ old('apellido', $doctor->apellido) }}"
                            maxlength="60"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Edad -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Edad:</label>
                        <input type="number" name="edad" value="{{ old('edad', $doctor->edad) }}" min="0"
                            max="999"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Número de Teléfono -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Número de Teléfono:</label>
                        <input type="text" name="numtel" value="{{ old('numtel', $doctor->numtel) }}" maxlength="15"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Botón Guardar -->
                    <div class="flex gap-4 mt-6">
                        <button type="submit"
                            class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded">
                            Guardar Cambios
                        </button>
                        <a href="{{ route('doctores.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
