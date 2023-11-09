<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis eventos') }}
        </h2>
        <div class="text-gray-600 mb-2">
            <p>Aquí puedes ver los eventos que has registrado así como dar seguimiento a su proceso de publicación.</p>
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

           <!-- Lista de eventos del usuario -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @if (!empty($events) && count($events) > 0)
                    @foreach ($events as $event)
                        <div class="bg-white dark:bg-gray-800 border border-gray-700 dark:border-gray-300 overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
                            <img src="{{ $event->cover_image }}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                                <p><strong>Fecha:</strong> {{ $event->start_date }} - {{ $event->end_date }}</p>
                                <p><strong>Horario:</strong> {{ $event->start_time }} - {{ $event->end_time }}</p>
                                {{-- <p><strong>Estado: </strong>{{$event->status}}</p> --}}
                                <p><strong>Espacio solicitado:</strong></p>
                                @if ($event->space_required)
                                    @foreach($event->spaces as $eventspace)
                                        {{$eventspace->name}} ({{$eventspace->location}})<br>
                                        {{-- Acceder al atributo "status" del espacio solicitado --}}
                                        @php
                                            $eventSpaceStatus = $eventspace->pivot->status;
                                        @endphp
                                        @if ($eventSpaceStatus == "solicitado"&&$event->status!="borrador")
                                            <p>Por favor espere mientras la(el) {{ $eventspace->department->name }} atiende su solicitud.</p>
                                        @elseif($eventSpaceStatus == "rechazado"&&$event->status!="borrador")
                                            <p><strong>Espacio rechazado:</strong> {{ $eventspace->pivot->observation }}</p>
                                        @elseif($eventSpaceStatus == "aceptado"&&$event->published==0)
                                            <p>Ahora puede publicar su evento dando clic en Publicar evento.</p>
                                        @endif
                                    @endforeach
                                @else
                                    No se requiere espacio
                                @endif                      
                                
                                {{-- @if ($event->status=="aceptado"&&$event->published==0)
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
                                @endif --}}
                                <!-- Con el estatus de borrador se invita al usuario a continuar con el registro-->
                                @if($event->status=='borrador')
                                    <p class="text-center text-red-600">
                                        <strong>¡EVENTO SIN REGISTRAR!</strong>
                                        <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Acude al departamento de adscripción para completar el registro">?</span>
                                    </p>
                                
                                <!-- Evento rechazado -->
                                @elseif($eventSpaceStatus == "rechazado"&&$event->status!="borrador")
                                    <p class="text-center text-red-600"><strong>¡ESPACIO RECHAZADO!</strong></p>
                                                                  
                                
                                <!-- Evento cancelado -->
                                @elseif($event->cancelled==1)
                                    <p class="text-center text-red-600"><strong>EVENTO CANCELADO!</strong></p>
                                    <p><strong>Motivo de cancelación:</strong> {{ $event->canceledEvent->cancellation_reason }}</p>                              

                                <!-- Con el estado de solicitado se le pide al usuario que espere la dictaminación -->
                                @elseif($eventSpaceStatus == "solicitado"&&$event->status!="borrador")
                                    <p class="text-center text-blue-600">
                                        <strong>¡ESPERANDO AUTORIZACIÓN DE ESPACIO!</strong>
                                        <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="El evento está registrado pero aún no está autorizado el uso del espacio solicitado, es necesario esperar la reserva del espacio.">?</span>
                                    </p>
                                
                                <!-- Con el estado de solicitado se le pide al usuario que espere la dictaminación -->
                                @elseif($event->status=='finalizado'&&$event->published==0&&$eventSpaceStatus == "aceptado")
                                    <p class="text-center text-blue-600">
                                        <strong>¡EVENTO SIN PUBLICAR!</strong>
                                        <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="El evento está registrado y se autorizó el uso de espacio sin emabargo aún no está publicado, acuda a su coordinación o división de adscripción para solicitar la publicación del evento.">?</span>
                                    </p>
                                

                                <!-- Evento publicado-->
                                @elseif($event->status=='finalizado'&&$event->published==1)
                                    <p class="text-center text-green-600"><strong>¡EVENTO PUBLICADO!</strong></p>
                                    
                                @endif
                                
                                
                                
                                <div class="mt-2">
                                    <a href="{{route('events.show',$event->id)}}" target="_blank" class="text-blue-500 hover:underline dark:text-blue-300">Detalle del evento</a>
                                </div>
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

        <div>
            {{ $events->links() }}
        </div>

    </div>
</x-app-layout>

<script>
    tippy('[data-tippy-content]');
</script>