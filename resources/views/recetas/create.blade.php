<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Nueva Receta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Registrar Nueva Receta</h1>

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

                <form action="{{ route('recetas.store') }}" method="POST">
                    @csrf

                    <label for="fechaIni" class="text-gray-700">Fecha Inicio:</label>
                    <input type="date" id="fechaIni" name="fechaIni" value="{{ old('fechaIni') }}" required>

                    <label for="fechaCad" class="text-gray-700">Fecha Caducidad:</label>
                    <input type="date" id="fechaCad" name="fechaCad" value="{{ old('fechaCad') }}" required>

                    <input type="hidden" value="{{ $citaid }}" name="cita_id">

                    <!-- Botón para añadir medicamentos -->
                    <button type="button" id="addMedicamento"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Añadir Medicamento
                    </button>

                    <div id="medicamentos"></div>

                    <!-- Botones -->
                    <div class="flex gap-4 mt-6">
                        <button type="submit"
                            class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded">
                            Guardar
                        </button>
                        <a href="{{ route('dashboard') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-black font-bold py-2 px-4 rounded">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para agregar medicamentos dinámicamente -->
    <script>
        document.getElementById('addMedicamento').addEventListener('click', function() {
            const container = document.getElementById('medicamentos');
            const index = document.querySelectorAll('.medicamento').length;

            const div = document.createElement('div');
            div.classList.add('medicamento', 'mb-2', 'flex', 'gap-4');

            div.innerHTML = `
                <select name="medicamentos[${index}][medicamento_id]" class="border p-2 rounded">
                    @foreach ($medicamentos as $medicamento)
                        <option value="{{ $medicamento->id }}">{{ $medicamento->nombre }}</option>
                    @endforeach
                </select>

                <input type="number" name="medicamentos[${index}][cantidad]" class="border p-2 rounded"
                    placeholder="Cantidad" required>

                <input type="text" name="medicamentos[${index}][horario]" class="border p-2 rounded"
                    placeholder="Horario" required>

                <button type="button" class="removeMedicamento bg-red-500 text-white px-2 py-1 rounded">X</button>
            `;

            container.appendChild(div);

            // Evento para eliminar medicamentos
            div.querySelector('.removeMedicamento').addEventListener('click', function() {
                div.remove();
            });
        });
    </script>
    <style>
        #medicamentos {
            margin-top: 20px;
        }

        select {
            width: 200px;
        }
    </style>
</x-app-layout>
