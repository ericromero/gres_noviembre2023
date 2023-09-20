<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight dark:bg-gray-800 text-gray-700 dark:text-gray-300">
            {{ __('Espacios Disponibles') }}
        </h2>
    </x-slot>

    <div class="dark:bg-gray-800 text-gray-700 dark:text-gray-300 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="py-2 border-t border-gray-700 dark:border-gray-300">
            Estimado Coordinador(a).<br>En este espacio puede consultar los diversos espacios gestionados por <b>{{$coordinatedDepartment->name}}</b>. Si requiere dar de alta un nuevo espacio o modificar la información de alguno de ellos, notifíquelo al administrador al correo ericrm@unam.mx.
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($spaces as $space)
                <div class="overflow-hidden shadow-md rounded-lg border border-gray-700 dark:border-gray-300">
                    <img src="{{ asset($space->photography) }}" alt="Imagen del espacio" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $space->name }}</h3>
                        <p>{{ $space->description }}</p>
                    </div>
                    <div class="p-4 border-t border-gray-700 dark:border-gray-300">
                        <p>Capacidad: {{ $space->capacity }}</p>
                        <p>Ubicación: {{ $space->location }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="p-4">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 ml-4 bg-red-500 text-white font-semibold rounded-md">Regresar</a>
        </div>
    </div>
</x-app-layout>
