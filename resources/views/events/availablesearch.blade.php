<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight dark:bg-gray-800 dark:text-white">
            {{ __('Búsqueda de espacio') }}
        </h2>
        <div class="mb-2 dark:bg-gray-800 dark:text-white">
            <p>Si para llevar a cabo tu evento requieres hacer uso de un espacio físico, ingresa las características de tu evento para verificar la disponibilidad de espacios.</p>
            <p>Si tu evento se realizará en la modalidad virtual, puedes omitir el buscador y continuar con el registro del evento.</p>
        </div>
    </x-slot>

    {{-- <div class="py-2"> --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800 text-gray-700 dark:text-gray-300">
            {{-- En este DIV se pone el formulario del buscador así como el calendario con eventos ya reservados --}}
            <div class="flex">
                <div class="p-2 border border-slate-400">
                    <form action="{{ route('spaces.search') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <table class="border-separate border-spacing-x-2">
                        <tr>
                            <th><label for="start_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha de inicio</label></th>
                            <th><label for="end_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha de fin</label></th>
                            <th><label for="start_time" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Hora de inicio</label></th>
                            <th><label for="end_time" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Hora de termino</label></th>
                            <th></th>
                            
                        </tr>
                        <tr>
                            <td><input class="dark:bg-gray-800 dark:text-white" type="date" name="start_date" min="{{ now()->addDays(4)->format('Y-m-d') }}" max="{{ now()->addMonths(6)->format('Y-m-d') }}" required></td>
                            <td><input class="dark:bg-gray-800 dark:text-white" type="date" name="end_date" min="{{ now()->addDays(4)->format('Y-m-d') }}" max="{{ now()->addMonths(6)->format('Y-m-d') }}" required></td>
                            <td><input class="dark:bg-gray-800 dark:text-white" type="time" name="start_time" required></td>
                            <td><input class="dark:bg-gray-800 dark:text-white" type="time" name="end_time" required></td>
                            <td><button class="block mb-4 text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 inline-block" type="submit">Buscar disponibilidad</button></td>
                        </tr>
                    </table>
                    </form>
                </div>
                {{-- <div class="mt-2">
                    <a href={{route('events.create')}} class="block ml-4 mb-4 text-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 inline-block" >Continuar</a>
                </div> --}}
                <div id="calendar" class="mx-2 p-2 border border-slate-400">
                    
                </div>
                

            </div>

            {{-- En este otro DIV se pone el resultado de la Búsqueda --}}
            <div>
                @if(isset($availableSpaces))
                    <div class="py-4">
                        <h2>A continuación se muestran los espacios disponibles, si alguno de ellos se adecúa a tus requerimientos, da clic en Seleccionar este espacio para continuar con el registro.</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-2">
                        @foreach($availableSpaces as $space)
                            <div class="overflow-hidden shadow-md rounded-lg border border-gray-700 dark:border-gray-300">
                                <img src="{{ asset($space->photography) }}" alt="Imagen del espacio" class="w-full h-40 object-cover">
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold">{{ $space->name }}</h3>
                                </div>
                                <div class="p-4 border-t border-gray-700 dark:border-gray-300">
                                    <p>Capacidad: {{ $space->capacity }} personas</p>
                                    <p>Ubicación: {{ $space->location }}</p>
                                </div>
                                <div class="px-4 pb-4">
                                    <a href="{{ route('events.createwithSpace', [
                                        'space' => $space->id,
                                        'start_date' => $start_date,
                                        'end_date' => $end_date,
                                        'start_time' => $start_time,
                                        'end_time' => $end_time,
                                    ]) }}" class="block mb-4 text-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 inline-block">
                                        Seleccionar este espacio
                                    </a>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h2>No hay espacios disponibles, es necesario buscar otra fecha y/o horario o bien realizarlo de manera virtual.</h2>
                @endif
            </div>


            {{-- <div class="overflow-hidden shadow-sm sm:rounded-lg"> --}}
                {{-- <div class="p-6 text-gray-900 dark:text-gray-100"> --}}
                    
                    
                    
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    {{-- </div> --}}

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src='fullcalendar/core/locales/es.global.js'></script>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            
          const calendarEl = document.getElementById('calendar');
          const calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es',
            initialView: 'dayGridMonth',
            events:@json($events),
            eventColor: '#551575',
            eventTimeFormat: {
                hour: 'numeric',
                minute: '2-digit',
                meridiem: 'short',
            },
            eventClick: function(info) {
                // Obtén el ID del evento haciendo referencia a info.event.id
                const eventId = info.event.id;
                
                // Redirige a la página de detalles del evento usando la ruta con el ID
                window.location.href = "{{ url('/evento/detalle') }}/" + eventId;
            },
          });
          calendar.render();
        });
  
      </script>

</x-app-layout>
