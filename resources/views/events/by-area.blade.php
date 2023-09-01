<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis eventos') }}
        </h2>
        <div class="text-gray-600 mb-2">
            <p>Aquí puedes ver los eventos registrados por el área.</p>
            <p>Si el prestamo requiere el uso de un espacio físico, podrá publicarlo hasta que este confirmado el uso del espacio.</p>
            <p>Una vez que el evento es publicado, aparecerá en la Cartelera pública</p>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Lista de eventos del area -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @if (!empty($events) && count($events) > 0)
                    @foreach ($events as $event)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
                            <img src="{{asset($event->cover_image)}}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                                <p class="text-gray-500 mb-2">{{ $event->summary }}</p>
                                <p><strong>Responsable:</strong> {{ $event->responsible->name }}</p>
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

                                <p><strong>Solicitud de espacio:</strong> {{ $event->eventspace->status }}</p>
                                @if($event->eventspace->status=="rechazado")
                                    <p><strong>Motivo de rechazo:</strong> {{ $event->eventspace->observation }}</p>                              
                                @endif                   
                                
                                @if($event->published==1)
                                    <p class="text-center text-green-600"><strong>¡EVENTO PUBLICADO!</strong>
                                        <button type="submit" class="text-red-500 hover:underline">Cancelar evento</button>
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
        </div>
    </div>
</x-app-layout>
