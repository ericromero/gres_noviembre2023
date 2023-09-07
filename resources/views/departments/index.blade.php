<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departamentos Disponibles') }}
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

            <!-- Botón para crear un nuevo departamento -->
            <a href="{{ route('departments.create') }}" class="block mb-4 text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 inline-block">
                <i class="fas fa-plus mr-2"></i>Agregar nuevo departamento
            </a>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($departments as $department)
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $department->name }}</h3>
                            <p class="text-gray-600">{{ $department->description }}</p>
                        </div>
                        <div class="p-4 border-t dark:border-gray-700">
                            <p class="text-gray-600">Responsable: {{ $department->responsible->name }}</p>
                        </div>
                        <div class="p-4 flex justify-end items-center space-x-2">
                            <a href="{{ route('departments.edit', $department) }}" class="text-blue-500 hover:underline">Actualizar</a>
                            <form action="{{ route('departments.destroy', $department) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este departamento?')">
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
