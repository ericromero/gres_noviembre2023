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
        @endif
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                <p class="text-gray-500 dark:text-gray-300 mb-2">{{ $event->summary }}</p>
                
                <p><strong>Espacio solicitado:</strong>
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
            </div>

            <div class="mt-4">            
                <form action="{{ route('eventspace.reject')}}" method="POST">
                    @csrf
                    <input type="hidden" name="event" value="{{ $event->id }}">
                    <div>
                        <label for="observation">Ingresa el motivo de rechazo de la solicitud de préstamo <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Redacta en un mínimo de 100 y máximo 2000 caracterés el motivo por el cual no procede el préstamo del espacio.">?</span></label>
                    </div>
                    
                    <div>                
                        <textarea name="observation" id="observation" required>{{ old('observation') }}</textarea>
                        @error('observation')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div id="char-count-container" class="text-sm">
                        Caracteres escritos: <span id="char-count">0</span> / 2000
                    </div>

                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">Rechazar préstamo de espacio</button>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('event_spaces.review') }}" class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md">Regresar</a>
                    </div>
                </form>
            </div>
        </div>        
    </div>

</x-app-layout>

<script>
    tippy('[data-tippy-content]');
</script>


<style>
    /* Estilos para el textarea */
    textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.2s;
    }

    /* Estilos para el contador de caracteres */
    #char-count-container {
        margin-top: 5px;
        color: #555;
    }

    /* Estilos cuando el contador de caracteres está dentro del rango */
    #char-count-container.valid {
        color: #4CAF50;
    }

    /* Estilos cuando el contador de caracteres está fuera del rango */
    #char-count-container.invalid {
        color: #D32F2F;
    }
</style>

<script>
    const textarea = document.getElementById('observation');
    const charCount = document.getElementById('char-count');
    const charCountContainer = document.getElementById('char-count-container');

    // Función para actualizar el contador y los estilos
    textarea.addEventListener('input', () => {
        const length = textarea.value.length;
        charCount.textContent = length;

        if (length < 100 || length > 2000) {
            textarea.classList.add('invalid');
            charCountContainer.classList.add('invalid');
        } else {
            textarea.classList.remove('invalid');
            charCountContainer.classList.remove('invalid');
        }
    });
</script>
