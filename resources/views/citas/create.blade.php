<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nueva Cita
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Registrar Nueva Cita Médica</h1>

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

                <form action="{{ route('citas.store') }}" method="POST">
                    @csrf

                    <!-- Orden -->
                    <div class="mb-4">
                        <label for="orden" class="block text-gray-700">Orden</label>
                        <input type="number" name="orden" id="orden"
                            class="w-full p-2 border border-gray-300 rounded" value="{{ old('orden') }}" min="0"
                            max="255" required>
                        @error('orden')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Fecha y Hora -->
                    <div class="mb-4">
                        <label for="fecha_hora" class="block text-gray-700">Fecha y Hora</label>
                        <input type="datetime-local" name="fecha_hora" id="fecha_hora"
                            class="w-full p-2 border border-gray-300 rounded" value="{{ old('fecha_hora') }}" required>
                        @error('fecha_hora')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Hora de Inicio -->
                    <div class="mb-4">
                        <label for="hora_ini" class="block text-gray-700">Hora de Inicio</label>
                        <input type="time" name="hora_ini" id="hora_ini"
                            class="w-full p-2 border border-gray-300 rounded" value="{{ old('hora_ini') }}" required>
                        @error('hora_ini')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Hora de Fin -->
                    <div class="mb-4">
                        <label for="hora_fin" class="block text-gray-700">Hora de Fin</label>
                        <input type="time" name="hora_fin" id="hora_fin"
                            class="w-full p-2 border border-gray-300 rounded" value="{{ old('hora_fin') }}" required>
                        @error('hora_fin')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Doctor -->
                    <div class="mb-4">
                        <label for="doctor_id" class="block text-gray-700">Doctor</label>
                        <select name="doctor_id" id="doctor_id" class="w-full p-2 border border-gray-300 rounded"
                            required>
                            <option value="">Seleccione un doctor</option>
                            @foreach ($doctores as $doctor)
                                <option value="{{ $doctor->id }}"
                                    {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                    {{ $doctor->nombre }}
                                </option>
                            @endforeach
                        </select>
                        @error('doctor_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Consulta -->
                    <div class="mb-4">
                        <label for="consulta_id" class="block text-gray-700">Consulta</label>
                        <select name="consulta_id" id="consulta_id" class="w-full p-2 border border-gray-300 rounded"
                            required>
                            <option value="">Seleccione una consulta</option>
                            @foreach ($consultas as $consulta)
                                <option value="{{ $consulta->id }}"
                                    {{ old('consulta_id') == $consulta->id ? 'selected' : '' }}>
                                    {{ $consulta->num }}
                                </option>
                            @endforeach
                        </select>
                        @error('consulta_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Usuario -->
                    <div class="mb-4">
                        <label for="userM_id" class="block text-gray-700">Usuario</label>
                        <select name="user_id" id="userM_id" class="w-full p-2 border border-gray-300 rounded"
                            required>
                            <option value="">Seleccione un usuario</option>
                            @foreach ($usersM as $userM)
                                <option value="{{ $userM->id }}"
                                    {{ old('userM_id') == $userM->id ? 'selected' : '' }}>
                                    {{ $userM->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('userM_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4 mt-6">
                        <button type="submit"
                            class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded">
                            Guardar Cita
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
