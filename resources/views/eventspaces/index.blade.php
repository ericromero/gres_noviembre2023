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
                        
                        <img src="{{asset($event->cover_image)}}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                        
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                            <p class="text-gray-500 dark:text-gray-300 mb-2">{{ $event->summary }}</p>
                            
                            <p><strong>Espacios solicitados:</strong>
                                @foreach($event->spaces as $event_space)
                                    {{$event_space->name;}}
                                @endforeach
                            </p>

                            
                            <p><strong>Deparamento solicitante:</strong> {{ $event->department->name }}</p>
                            <p><strong>Responsable:</strong> {{ $event->responsible->name }}</p>
                            <p><strong>Fecha:</strong> Del {{ $event->start_date }} al {{ $event->end_date }}</p>
                            <p><strong>Horario:</strong> De {{ $event->start_time }} a {{ $event->end_time }}</p>                                                        
                            
                            @if ($event->registration_url!=null)
                                <p><strong>Registro:</strong><a href="{{ $event->registration_url }}" target="_blank" class="text-blue-600 hover:text-blue-900 underline"> {{ $event->registration_url }}</a></p>
                            @else
                                <p><strong>Registro:</strong>No se requiere</p>
                            @endif

                            @if ($event->program)
                                <p><a href="{{ asset($event->program) }}" class="text-blue-600 hover:text-blue-900 underline" download>Descargar Programa</a></p>
                            @endif

                            <!-- Botones de Autorizar y Rechazar -->
                            <div class="mt-4 space-x-2">
                                <form action="{{ route('events.authorize', $event->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md">Autorizar</button>
                                </form>

                                <form action="{{ route('events.reject', $event->id) }}" method="POST">
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
