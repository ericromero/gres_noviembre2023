<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Espacios Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="py-4 border-t dark:border-gray-700 text-gray-700">
                        Estimado Coordinador(a).<br>En este espacio puede consultar los diversos espacios gestionados por <b>{{$coordinatedDepartment->name}}</b>. Si requiere dar de alta un nuevo espacio o modificar la información de alguno de ellos, notifíquelo al administrador al correo ericrm@unam.mx.
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($spaces as $space)
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                                <img src="{{ asset($space->photography) }}" alt="Imagen del espacio" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold">{{ $space->name }}</h3>
                                    <p class="text-gray-600">{{ $space->description }}</p>
                                </div>
                                <div class="p-4 border-t dark:border-gray-700">
                                    <p class="text-gray-600">Capacidad: {{ $space->capacity }}</p>
                                    <p class="text-gray-600">Ubicación: {{ $space->location }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
