<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Recetas Médicas de {{ $usuario->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @foreach ($usuario->citas as $cita)
                    @if ($cita->receta)
                        <div class="mb-6 p-4 border rounded-lg shadow">
                            <h1 class="text-2xl font-bold text-blue-700">Receta válida hasta
                                {{ $cita->receta->fechaCad }}</h1>
                            <hr class="my-2">

                            @foreach ($cita->receta->medicamentos as $medicamento)
                                <p class="text-gray-700">
                                    <strong>{{ $medicamento->nombre }}</strong>:
                                    Cantidad: {{ $medicamento->pivot->cantidad }},
                                    Precio: ${{ $medicamento->precio }},
                                    Horario: {{ $medicamento->pivot->horario }},
                                    Aplicación: {{ $medicamento->aplicacion }},
                                    Cantidad/unidad: {{ $medicamento->cantidad }}
                                </p>
                            @endforeach
                        </div>
                    @endif
                @endforeach

                @if ($usuario->citas->whereNotNull('receta')->isEmpty())
                    <p class="text-gray-500">Este usuario no tiene recetas registradas.</p>
                @endif

            </div>
        </div>
    </div>
    <style>
        div.mb-6 {
            padding: 10px;
        }
    </style>
</x-app-layout>
