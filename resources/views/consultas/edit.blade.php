<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Consulta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Editar Consulta</h1>

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

                <form action="{{ route('consultas.update', $consulta->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Número de Consulta -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Número de Consulta:</label>
                        <input type="number" name="num" value="{{ old('num', $consulta->num) }}" 
                               class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Tipo de Sala -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Tipo de Sala:</label>
                        <input type="text" name="tipoSala" value="{{ old('tipoSala', $consulta->tipoSala) }}" 
                               class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Centro Médico -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Centro Médico:</label>
                        <select name="centro_medico_id" 
                                class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled>Selecciona un centro médico</option>
                            @foreach ($centrosMedicos as $centro)
                                <option value="{{ $centro->id }}" 
                                    {{ $consulta->centro_medico_id == $centro->id ? 'selected' : '' }}>
                                    {{ $centro->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Botón Guardar -->
                    <div class="flex gap-4 mt-6">
                        <button type="submit" 
                                class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded">
                            Guardar Cambios
                        </button>
                        <a href="{{ route('consultas.index') }}" 
                           class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
