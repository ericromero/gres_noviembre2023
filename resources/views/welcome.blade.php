<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cartelera') }}
        </h2>
        <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 mb-2">
            <p>Ven a disfrutar de los diversos eventos académicos, culturales y deportivos que la Facultad de Psicología tiene para tí.</p>
        </div>
    </x-slot>

    <div class="py-2 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($events->isEmpty())
                <div class="text-center">
                    <p class="text-xl font-semibold">No hay eventos próximos</p>
                </div>
            @else
                <div class="mb-4">
                    <a href="{{route('eventos.calendario')}}" class="text-blue-500 hover:underline">Ver calendario</a>
                </div>
                <div class="grid gap-4 grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ($events as $event)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
                            <img src="{{asset($event->cover_image)}}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                                <p class="text-gray-500 mb-2">{{ $event->summary }}</p>
                                <p><strong>Responsable:</strong> {{ $event->responsible->name }}</p>
                                <p><strong>Fecha:</strong> {{ $event->start_date }}
                                @if($event->start_date!=$event->end_date)
                                 - {{ $event->end_date }}
                                @endif
                                </p>
                                <p><strong>Horario:</strong> {{ $event->start_time }} - {{ $event->end_time }}</p>
                                <p><strong>Lugar:</strong> {{ $event->eventspace->space->name }}</p>
                                <p><strong>Ubicacion:</strong> {{ $event->eventspace->space->location }}</p>
                                
                                @if ($event->registration_url!=null)
                                    <p><strong>Registro:</strong> {{ $event->registration_url }}</p>
                                @else
                                    <p><strong>Registro:</strong>No se requiere</p>
                                @endif

                                @if ($event->program)
                                    <p><a href="{{ asset($event->program) }}" class="text-blue-600 hover:text-blue-900 underline" download>Descargar Programa</a></p>
                                @endif

                                @if ($event->registration_required)
                                    <a href="{{ $event->registration_url }}" class="mt-2 block text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Registrarse</a>
                                @endif
                            </div>
                            
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
