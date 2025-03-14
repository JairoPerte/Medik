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
                            <form action="/citas/create">
                                <button type="submit">Crear cita</button>
                            </form>
                        </div>

                        <form action="/recetas/create" method="get" id="obtener-cita" style="color: wheat">
                            <select name="cita" id="cita-med" class="cita-select">
                                @foreach ($citas as $cita)
                                    <option value="{{ $cita->id }}">
                                        {{ $cita->user->nif }} a las {{ $cita->fecha_hora }}</option>
                                @endforeach
                            </select>
                            <button type="submit">Asignar Receta</button>
                        </form>

                        @if (session('success'))
                            <div id="success-message" style="color: green; transition: opacity 1s;">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div id="error-message" style="color: red; transition: opacity 1s;">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>


                    <style>
                        #seccion-upper {
                            margin: 20px auto;
                            width: 90%;
                            line-height: 45px
                        }

                        #botones {
                            color: wheat;
                            display: flex;
                            flex-direction: row;
                            gap: 10px;
                            flex-wrap: wrap;
                            font-family: Arial, Helvetica, sans-serif
                        }

                        select {
                            margin-right: 30px;
                        }

                        .cita-select {
                            color: black
                        }
                    </style>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            setTimeout(function() {
                                let successMessage = document.getElementById('success-message');
                                let errorMessage = document.getElementById('error-message');

                                if (successMessage) {
                                    successMessage.style.opacity = '0';
                                    setTimeout(() => successMessage.style.display = 'none',
                                        1000); // Elimina el elemento tras desvanecerse
                                }

                                if (errorMessage) {
                                    errorMessage.style.opacity = '0';
                                    setTimeout(() => errorMessage.style.display = 'none', 1000);
                                }
                            }, 2000); // Espera 2 segundos antes de iniciar la animación
                        });
                    </script>
                @endadmin
            </div>
        </div>
    </div>
</x-app-layout>
