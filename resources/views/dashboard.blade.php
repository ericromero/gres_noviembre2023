<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestor de Recursos, Espacios y Servicios ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                
                <!-- Imagen y enlace para gestionar permisos -->
                {{-- <a href="{{ route('permissions.index') }}"> --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 cursor-pointer">
                        <img src="{{ asset('images/permisos.png') }}" alt="Permisos" class="mx-auto h-20">
                        <p class="text-center mt-2 text-gray-900 dark:text-gray-100">Permisos</p>
                    </div>
                {{-- </a> --}}

                <!-- Imagen y enlace para gestionar usuarios -->
                {{-- <a href="{{ route('users.index') }}"> --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 cursor-pointer">
                        <img src="{{ asset('images/usuarios.png') }}" alt="Usuarios" class="mx-auto h-20">
                        <p class="text-center mt-2 text-gray-900 dark:text-gray-100">Usuarios</p>
                    </div>
                {{-- </a> --}}

                <!-- Imagen y enlace para gestionar departamentos -->
                {{-- <a href="{{ route('departments.index') }}"> --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 cursor-pointer">
                        <img src="{{ asset('images/departamento.png') }}" alt="Departamentos" class="mx-auto h-20">
                        <p class="text-center mt-2 text-gray-900 dark:text-gray-100">Departamentos</p>
                    </div>
                {{-- </a> --}}

                <!-- Imagen y enlace para gestionar espacios -->
                {{-- <a href="{{ route('spaces.index') }}"> --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 cursor-pointer">
                        <img src="{{ asset('images/espacios.png') }}" alt="Espacios" class="mx-auto h-20">
                        <p class="text-center mt-2 text-gray-900 dark:text-gray-100">Espacios</p>
                    </div>
                {{-- </a> --}}

                <!-- Imagen y enlace para crear evento -->
                <a href="{{ route('events.my-events') }}">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 cursor-pointer">
                        <img src="{{ asset('images/evento.png') }}" alt="Mis eventos" class="mx-auto h-20">
                        <p class="text-center mt-2 text-gray-900 dark:text-gray-100">Mis eventos</p>
                    </div>
                </a>

                <!-- Imagen y enlace para solicitar espacio -->
                {{-- <a href="{{ route('event-schedule.create') }}"> --}}
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 cursor-pointer">
                        <img src="{{ asset('images/calendario.png') }}" alt="Solicitar espacio" class="mx-auto h-20">
                        <p class="text-center mt-2 text-gray-900 dark:text-gray-100">Solicitar espacio</p>
                    </div>
                {{-- </a> --}}

                <!-- Imagen y enlace para revisar los eventos solicitados -->
                <a href="{{ route('events.review-events') }}">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 cursor-pointer">
                        <img src="{{ asset('images/autorizacioneventos.png') }}" alt="Autorización de eventos" class="mx-auto h-20">
                        <p class="text-center mt-2 text-gray-900 dark:text-gray-100">Autorización de eventos</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>


{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
