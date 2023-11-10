<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight dark:bg-gray-800 dark:text-white">
            {{ __('Eventos por día') }}
        </h2>        
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-hidden shadow-sm sm:rounded-lg dark:bg-gray-800 text-gray-700 dark:text-gray-300">
        
        {{-- DIV se pone el formulario del buscador así como el calendario con eventos ya reservados --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-2">
                       
            <div class="mx-2 p-2 border border-slate-400">
                <div class="mb-2 dark:bg-gray-800 dark:text-white border-b border-gray-700 dark:border-gray-300">
                    <p>Aquí puedes ver los eventos ya publicados.</p>
                </div>
                <div id="calendar">
                </div>                
            </div>
        </div>
    </div>


<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script src='fullcalendar/core/locales/es.global.js'></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        
        const calendarEl = document.getElementById('calendar');
        const calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        initialView: 'timeGridDay',
        nowIndicator: true,
        today:    'Día de hoy',
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
            
            var url = "{{ url('/evento/detalle') }}/" + eventId;

            // Abre la URL en una nueva ventana
            window.open(url, '_blank');
        },

        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            list: 'Lista'
        },
        
        });

        
        calendar.render();
    });

</script>

</x-app-layout>
