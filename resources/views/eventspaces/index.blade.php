<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Espacios solicitados') }}
        </h2>

    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
        {{-- Código para el manejo de notificaciones --}}
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif
        
        @if ($events->isEmpty())
            <div class="text-center">
                <p class="text-xl font-semibold">No hay solicitudes que atender</p>
            </div>
        @else
            <div class="grid gap-4 grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($events as $event)
                    <div class="overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4 border border-gray-700 dark:border-gray-300">
                        <img src="{{asset($event->event->cover_image)}}" alt="{{ $event->event->title }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $event->event->title }}</h2>
                            <p class="text-gray-500 dark:text-gray-300 mb-2">{{ $event->event->summary }}</p>
                            <p><strong>Espacio solicitado:</strong> {{ $event->space->name }}</p>
                            <p><strong>Responsable:</strong> {{ $event->event->responsible->name }}</p>
                            <p><strong>Fecha:</strong> {{ $event->event->start_date }} - {{ $event->event->end_date }}</p>
                            <p><strong>Horario:</strong> {{ $event->event->start_time }} - {{ $event->event->end_time }}</p>
                                                        
                            
                            @if ($event->event->registration_url!=null)
                                <p><strong>Registro:</strong> {{ $event->event->registration_url }}</p>
                            @else
                                <p><strong>Registro:</strong>No se requiere</p>
                            @endif

                            @if ($event->event->program)
                                <p><a href="{{ asset($event->event->program) }}" class="text-blue-600 hover:text-blue-900 underline" download>Descargar Programa</a></p>
                            @endif

                            @if ($event->registration_required)
                                <a href="{{ $event->event->registration_url }}" class="mt-2 block text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Registrarse</a>
                            @endif

                            <!-- Botones de Autorizar y Rechazar -->
                            <div class="mt-4 space-x-2">
                                <form action="{{ route('events.authorize', $event->event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md">Autorizar</button>
                                </form>

                                <form action="{{ route('events.reject', $event->event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md">Rechazar</button>
                                    <input type="text" name="observation" placeholder="Justificación" class="px-2 py-1 border rounded-md dark:bg-gray-800 dark:text-white" required>
                                </form>
                            </div>

                        </div>
                        
                    </div>
                @endforeach
            </div>
        @endif

        <div class="items-center my-4 ml-4">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md">Regresar</a>
        </div>
        
    </div>

</x-app-layout>
