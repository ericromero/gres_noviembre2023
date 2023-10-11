<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Eventos de la División/Coordinación') }}
        </h2>
        <div class="mb-2 text-gray-800 dark:text-gray-200 ">
            <p>Aquí puedes ver los eventos registrados por el área.</p>
            <p>Si el prestamo requiere el uso de un espacio físico, podrá publicarlo hasta que este confirmado el uso del espacio.</p>
            <p>Una vez que el evento es publicado, aparecerá en la Cartelera pública</p>
        </div>
    </x-slot>

    <div class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">

        <!-- Lista de eventos del area -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @if (!empty($events) && count($events) > 0)
                @foreach ($events as $event)
                    <div class="overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4 border border-gray-700 dark:border-gray-300">
                        <img src="{{asset($event->cover_image)}}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                            <p class="text-gray-500 dark:text-gray-300 mb-2">{{ $event->summary }}</p>
                            <p><strong>Solicitante:</strong> {{ $event->responsible->name }} ({{$event->department->name}})</p>
                            <p><strong>Fecha:</strong> {{ $event->start_date }} - {{ $event->end_date }}</p>
                            <p><strong>Horario:</strong> {{ $event->start_time }} - {{ $event->end_time }}</p>
                                                            
                            
                            @if ($event->registration_url!=null)
                                <p><strong>Registro:</strong> {{ $event->registration_url }}</p>
                            @else
                                <p><strong>Registro:</strong>No se requiere</p>
                            @endif

                            @if ($event->program)
                            <p><a href="{{ asset($event->program) }}" class="text-blue-600 hover:text-blue-900 underline" download>Descargar Programa</a></p>
                            @endif

                            <p><strong>Espacio solicitado espacio:</strong>
                                @if ($event->space_required)
                                    @foreach($event->spaces as $eventspace)
                                        {{$eventspace->name}} ({{$eventspace->location}})<br>
                                        @if($eventspace->status=="rechazado")
                                            <p><strong>Motivo de rechazo:</strong> {{ $eventspace->observation }}</p>                              
                                        @endif
                                    @endforeach
                                @else
                                    No se requiere espacio
                                @endif
                            </p>
                            
                            @if($event->published==1)
                                <p class="text-center text-green-600"><strong>¡EVENTO PUBLICADO!</strong>
                                {{-- <button type="submit" class="text-red-500 hover:underline">Cancelar evento</button> --}}
                            @endif
                        </div>
                        
                    </div>
                @endforeach
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-sm sm:rounded-lg p-4 text-center">
                    <p class="text-gray-500 mb-2">No tienes eventos registrados.</p>
                </div>
            @endif
        </div>

        <div class="items-center my-4 ml-4">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md">Regresar</a>
        </div>


    </div>
</x-app-layout>

