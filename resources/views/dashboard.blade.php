<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @user
                    <x-userdashboard />
                @enduser
                @admin
                    {{-- <x-admindashboard /> --}}
                    <div id="seccion-upper">
                        <div id="botones">
                            <form action="/consultas" method="get">
                                <button type="submit">Ir a Consultas</button>
                            </form>
                            |
                            <form action="/doctores" method="get">
                                <button type="submit">Ir a Doctores</button>
                            </form>
                            |
                            <form action="/centro-medico" method="get">
                                <button type="submit">Ir a Centro Medico</button>
                            </form>
                            |
                            <form action="/recetas" method="get">
                                <button type="submit">Ir a Recetas</button>
                            </form>
                            |
                            <form action="/citas/create">
                                <button type="submit">Crear cita</button>
                            </form>
                        </div>

                        <form action="/receta/create" method="get" id="obtener-cita" style="color: wheat">
                            <select name="cita" id="cita-med" class="cita-select">
                                @foreach ($citas as $cita)
                                    <option value="{{ $cita->id }}">
                                        {{ $cita->user->name }} a las {{ $cita->fecha_hora }}</option>
                                @endforeach
                            </select>
                            <button type="submit">Nueva Receta de una Cita</button>
                        </form>
                    </div>


                    <style>
                        #seccion-upper {
                            margin: 20px auto;
                            width: 90%;
                        }

                        #botones {
                            color: wheat;
                            display: flex;
                            flex-direction: row;
                            gap: 10px;
                            flex-wrap: wrap;
                            font-family: Arial, Helvetica, sans-serif
                        }

                        .cita-select {
                            color: black
                        }
                    </style>

                    <script>
                        let form = document.getElementById("obtener-cita").addEventListener("submit", (evento) => {
                            evento.preventDefault();
                        });
                    </script>
                @endadmin
            </div>
        </div>
    </div>
</x-app-layout>
