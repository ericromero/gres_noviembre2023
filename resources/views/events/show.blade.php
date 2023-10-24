<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $event->title }}
        </h2>
    </x-slot>

    {{-- <div class="py-6"> --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
            {{-- <div class="overflow-hidden shadow-sm sm:rounded-lg"> --}}
                <div class="flex">
                    <div class="mb-2">
                        <a href="{{route('eventos.cartelera')}}" class="text-blue-500 hover:underline dark:text-blue-300">Ver cartelera</a>
                    </div>
                    <div class="mb-2 ml-4">
                        <a href="{{route('eventos.calendario')}}" class="text-blue-500 hover:underline dark:text-blue-300">Ver calendario</a>
                    </div>
                </div>
                <div class="p-6 border border-gray-700 dark:border-gray-300">
                    <img src="{{asset($event->cover_image)}}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
                    <h2 class="text-2xl font-semibold">Resumen:</h2>
                    <p>{{ $event->summary }}</p>

                    <div class="mt-4">
                        <p><strong>Responsable:</strong> {{ $event->responsible->name }}</p>
                        <p><strong>Fecha:</strong> {{ $event->start_date }}
                            @if($event->start_date!=$event->end_date)
                             - {{ $event->end_date }}
                            @endif
                        </p>
                        <p><strong>Horario:</strong> {{ $event->start_time }} - {{ $event->end_time }}</p>
                        <p><strong>Lugar:</strong>
                            @foreach($event->spaces as $event_space)
                                {{$event_space->name;}} ({{$event_space->location}})
                            @endforeach
                        </p>
                    </div>

                    @if ($event->program)
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Programa:</h3>
                        <a href="{{ asset($event->program) }}" class="text-blue-600 hover:underline dark:text-blue-300" download>Descargar Programa</a>
                    </div>
                    @endif

                    <!-- Lista de participantes -->
                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Participantes</h3>
                        @if ($participants!=null&&$participants->count() > 0)
                            <table class="border border-gray-700 dark:border-gray-300">
                                <thead class="bg-gray-300 dark:bg-gray-700">
                                    <tr>
                                        <th class="px-4 py-2">Nombre completo</th>
                                        <th class="px-4 py-2">Tipo de participación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($participants as $participant)
                                        <tr>
                                            <td class="px-4 py-2">
                                                @if($participant->user_id!=null)
                                                    {{ $participant->user->degree }}
                                                @endif 
                                                {{ $participant->fullname }}
                                            </td>
                                            <td class="px-4 py-2">{{ $participant->participationType->name }}</td>
                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No hay participantes agregados al evento.</p>
                        @endif
                    </div>                    

                    <div class="mt-4">
                        <h3 class="text-lg font-semibold">Registro:</h3>
                        @if ($event->registration_url!=null)
                            @if ($event->start_time > now() )
                                <a href="{{ $event->registration_url }}" class="mt-2 block text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Registrarse</a>
                            @else
                            {{ $event->registration_url }}
                            @endif
                        @else
                            No se requiere
                        @endif
                    </div>

                </div>
            {{-- </div> --}}
        </div>
    {{-- </div> --}}
</x-app-layout>
