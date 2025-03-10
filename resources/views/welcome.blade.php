<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Medik</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body
    class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif
    </header>
    <div
        class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
        <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row bg-[#111827]">
            <div
                class="text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 bg-[#1f2937] text-white shadow rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                <h1 class="mb-1 font-medium text-lg">Medik</h1>
                <p class="mb-2 text-[#d1d5db]">La página oficial para organizar tus citas médicas. <br> Accede
                    fácilmente a tu historial médico, programa consultas con especialistas y gestiona tus citas de forma
                    rápida y segura.</p>
                <ul class="flex flex-col mb-4 lg:mb-6">
                    <li
                        class="flex items-center gap-4 py-2 relative before:border-l before:border-[#374151] before:top-1/2 before:bottom-0 before:left-[0.4rem] before:absolute">
                        <span class="relative py-1 bg-[#1f2937]">
                            <span
                                class="flex items-center justify-center rounded-full bg-[#374151] shadow w-3.5 h-3.5 border border-[#4b5563]">
                                <span class="rounded-full bg-[#6b7280] w-1.5 h-1.5"></span>
                            </span>
                        </span>
                        <span>
                            Consulta nuestra
                            <a href="#"
                                class="inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#22c55e] ml-1">
                                <span>Guía de usuario</span>
                            </a>
                        </span>
                    </li>
                    <li
                        class="flex items-center gap-4 py-2 relative before:border-l before:border-[#374151] before:bottom-1/2 before:top-0 before:left-[0.4rem] before:absolute">
                        <span class="relative py-1 bg-[#1f2937]">
                            <span
                                class="flex items-center justify-center rounded-full bg-[#374151] shadow w-3.5 h-3.5 border border-[#4b5563]">
                                <span class="rounded-full bg-[#6b7280] w-1.5 h-1.5"></span>
                            </span>
                        </span>
                        <span>
                            Descubre nuestros
                            <a href="#"
                                class="inline-flex items-center space-x-1 font-medium underline underline-offset-4 text-[#22c55e] ml-1">
                                <span>Servicios médicos</span>
                            </a>
                        </span>
                    </li>
                </ul>
                <ul class="flex gap-3 text-sm leading-normal">
                    <li>
                        <a href="#"
                            class="inline-block bg-[#22c55e] hover:bg-[#16a34a] px-5 py-1.5 rounded-sm border border-[#16a34a] text-white text-sm leading-normal">
                            Registrarse ahora
                        </a>
                    </li>
                </ul>
            </div>
            <div
                class="bg-[#d1fae5] relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden flex items-center justify-center text-[#065f46] text-lg font-semibold">
                ¡Regístrate y pide cita ya!
            </div>
        </main>
    </div>
</body>

</html>
