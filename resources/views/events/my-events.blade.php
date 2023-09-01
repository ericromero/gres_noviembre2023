<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis eventos') }}
        </h2>
        <div class="text-gray-600 mb-2">
            <p>Aquí puedes ver los eventos que has registrado así como dar seguimiento a su estado.</p>
            <p>Una vez que un evento es aceptado, puedes solicitar el uso de un espacio, de servicios y/o publicarlo en la cartelera. Una vez que el evento ha sido publicado, ya no se puede solicitar el uso de espacio o servicio.</p>
            <p>Si aún no tienes eventos registrados, puedes crear uno nuevo dando clic en el botón "Crear evento".</p>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">  
            {{-- Código para el manejo de notificaciones --}}
            @if(session('success'))
                <div class="bg-green-200 text-green-800 p-4 mb-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Botón para crear evento -->
            <a href="{{ route('events.create') }}" class="block mb-4 text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 inline-block">
                <i class="fas fa-plus mr-2"></i>Crear evento
            </a>

            <!-- Lista de eventos del usuario -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @if (!empty($userEvents) && count($userEvents) > 0)
                    @foreach ($userEvents as $event)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
                            <img src="{{ $event->cover_image }}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                                <p class="text-gray-500 mb-2">{{ $event->summary }}</p>
                                <p><strong>Fecha:</strong> {{ $event->start_date }} - {{ $event->end_date }}</p>
                                <p><strong>Horario:</strong> {{ $event->start_time }} - {{ $event->end_time }}</p>
                                <p><strong>Espacio:</strong> {{ $event->space->name }}</p>
                                @if ($event->registration_url!=null)
                                    <p><strong>Registro:</strong> {{ $event->registration_url }}</p>
                                @else
                                    <p><strong>Registro:</strong>No se requiere</p>
                                @endif
                                <p><strong>Estatus:</strong> {{ $event->status }}</p>
                                @if($event->status=="rechazado")
                                    <p><strong>Motivo de rechazo:</strong> {{ $event->canceledEvent->cancellation_reason }}</p>                              
                                @endif
                                
                                @if ($event->status=="aceptado"&&$event->published==0)
                                    <div>
                                        <div>
                                            <a href="{{ route('events.create') }}" class="block mb-4 text-center px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600">
                                            <i class="fas fa-plus mr-2"></i>Solicitar espacio
                                            </a>
                                        </div>
                                        <div>
                                            <form action="{{ route('events.publish', ['id' => $event->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="block mb-4 text-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                                    Publicar Evento
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                @if($event->published==1)
                                    <p class="text-center text-green-600"><strong>¡EVENTO PUBLICADO!</strong>
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

