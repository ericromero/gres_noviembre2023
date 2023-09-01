<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Espacios Disponibles') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Código para el manejo de notificaciones --}}
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Botón para crear un nuevo espacio -->
            <a href="{{ route('spaces.create') }}" class="block mb-4 text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 inline-block">
                <i class="fas fa-plus mr-2"></i>Agregar nuevo espacio
            </a>


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
                            <p class="text-gray-600">Disponibilidad: {{ $space->availability }}</p>
                        </div>
                        <div class="p-4 flex justify-end items-center space-x-2">
                            <a href="{{ route('spaces.edit', $space) }}" class="text-blue-500 hover:underline">Editar</a>
                            <form action="{{ route('spaces.destroy', $space) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este espacio?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Borrar</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
