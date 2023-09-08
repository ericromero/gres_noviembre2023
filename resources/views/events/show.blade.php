<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex">
                    <div class="mb-2">
                        <a href="{{route('eventos.cartelera')}}" class="block mb-4 text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 inline-block">Ver cartelera</a>
                    </div>
                    <div class="mb-2 ml-4">
                        <a href="{{route('eventos.calendario')}}" class="block mb-4 text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 inline-block">Ver calendario</a>
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 dark:border-gray-700">
                    <img src="{{asset($event->cover_image)}}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                    <h2 class="text-2xl font-semibold">Resumen:</h2>
                    <p class="text-gray-600">{{ $event->summary }}</p>

                    <div class="mt-4">
                        <p><strong>Responsable:</strong> {{ $event->responsible->name }}</p>
                        <p><strong>Fecha:</strong> {{ $event->start_date }}
                            @if($event->start_date!=$event->end_date)
                             - {{ $event->end_date }}
                            @endif
                        </p>
                        <p><strong>Horario:</strong> {{ $event->start_time }} - {{ $event->end_time }}</p>
                        <p><strong>Lugar:</strong> {{ $event->eventspace->space->name }}</p>
                        <p><strong>Ubicacion:</strong> {{ $event->eventspace->space->location }}</p>
                    </div>

                    @if ($event->program)
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Programa:</h3>
                        <a href="{{ asset($event->program) }}" class="text-blue-600 hover:text-blue-900 underline" download>Descargar Programa</a>
                    </div>
                    @endif

                    @if ($event->registration_url!=null)
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">Registro:</h3>{{ $event->registration_url }}
                        </div>
                    @else
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Registro:</h3> No se requiere
                    </div>
                    @endif

                    @if ($event->registration_required)
                        <a href="{{ $event->registration_url }}" class="mt-2 block text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Registrarse</a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
