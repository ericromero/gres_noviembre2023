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
        @elseif(session('error'))
            <div class="bg-red-200 text-red-800 p-4 mb-4 rounded-md">
                {{ session('error') }}
            </div>
        @endif
        
        @if ($events->isEmpty())
            <div class="text-center">
                <p class="text-xl font-semibold">No hay solicitudes que atender</p>
            </div>
        @else
            <div class="grid gap-4 grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($events as $event)
                    
                    <!-- Código para saber si está rechazado -->
                    @php
                        $rechazado=false;
                        $motivo=null;
                        if ($event->space_required) {
                            foreach($event->spaces as $eventspace) {
                                $eventSpaceStatus = $eventspace->pivot->status;
                                if($eventSpaceStatus == "rechazado"&&$event->status!="borrador") {
                                    $rechazado=true;
                                    $motivo=$eventspace->pivot->observation;
                                }
                            }
                        }
                    @endphp

                    <div class="overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4 border border-gray-700 dark:border-gray-300
                        @if($rechazado)
                            bg-red-50 border-red-700
                        @elseif(!$rechazado&&$event->status=="finalizado")
                            bg-green-50 border-green-700
                        @else
                            bg-yellow-50 border-yellow-600
                        @endif
                        ">
                        
                        <img src="{{asset($event->cover_image)}}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                        
                        <div class="p-4">
                            <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                            <p class="text-gray-500 dark:text-gray-300 mb-2">{{ $event->summary }}</p>
                            
                            <p><strong>Espacios solicitados:</strong>
                                @foreach($event->spaces as $event_space)
                                    {{$event_space->name;}}
                                @endforeach
                            </p>

                            
                            <p><strong>Departamento solicitante:</strong> {{ $event->department->name }}</p>
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

                            @if($rechazado)
                                <p><strong>Motivo de rechazo:</strong> {{ $motivo }}</p>
                            @endif

                            <!-- Botones de Autorizar y Rechazar -->
                            @if($event->status=="solicitado")
                                <div class="mt-4 flex">
                                    <div>
                                        <a href="{{ route('eventspace.authorize', $event->id) }}" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md">Autorizar</a>
                                    </div>
                                    
                                    <div class="ml-2">
                                        <a href="{{ route('eventspace.preReject', $event->id) }}" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md">Rechazar</a>
                                    </div>                                
                                </div>
                            @endif
                        </div>
                        
                    </div>
                @endforeach
            </div>

            <div>
                {{ $events->links() }}
            </div>
            
        @endif

        <div class="items-center my-4">
            <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md">Regresar</a>
        </div>
        
    </div>

</x-app-layout>
