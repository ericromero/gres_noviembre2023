<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cancelar evento') }}
        </h2>
        <div class="text-gray-600 mb-2">
            <p class="text-gray-900 dark:text-gray-100">
                Para cancelar este evento, escriba una justificación de entre 100 y 2000 caracteres (incluyendo espacios) y haga clic en Cancelar evento.
            </p>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-hidden shadow-sm sm:rounded-lg grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Contenedor con la información del curso a cancelar -->
        <div class="border border-gray-700 dark:border-gray-100 bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
            <img src="{{asset($event->cover_image)}}" alt="{{ $event->title }}" class="w-full h-40 object-cover">
            <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $event->title }}</h2>
                <p class="text-gray-500 mb-2">{{ $event->summary }}</p>
                <p><strong>Responsable:</strong> {{ $event->responsible->name }}</p>
                <p><strong>Fecha:</strong> {{ $event->start_date }}
                @if($event->start_date!=$event->end_date)
                    - {{ $event->end_date }}
                @endif
                </p>
                <p><strong>Horario:</strong> {{ $event->start_time }} - {{ $event->end_time }}</p>
                <p><strong>Lugar:</strong>
                    @foreach($event->spaces as $event_space)
                        {{$event_space->name}} ({{$event_space->location}})<br>
                    @endforeach
                </p>foreach
                </p>
                
                @if ($event->registration_url!=null)
                    <p><strong>Registro:</strong> {{ $event->registration_url }}</p>
                @else
                    <p><strong>Registro:</strong>No se requiere</p>
                @endif

                @if ($event->program)
                    <p><a href="{{ asset($event->program) }}" class="text-blue-600 hover:text-blue-900 underline" download>Descargar Programa</a></p>
                @endif
            </div>
        </div>

        <!-- Formulario para cancelación del evento -->
        <div class="border border-gray-700 dark:border-gray-100 bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
            <form action="{{ route('event.cancel',$event) }}" method="POST">
                @csrf
                <div class="p-4">
                    <label class="block font-bold mb-2" for="justify">Motivo de cancelación</label><br>
                    <textarea name="justify" id="justify" cols="30" rows="10" maxlength="2000" class="w-full form-textarea dark:bg-gray-800 dark:text-white @error('justify') border-red-500 @enderror" required>{{ old('justify') }}</textarea>
                    @error('justify')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 dark:text-gray-300 text-sm">Caracteres restantes: <span id="char-count-justify">2000</span></p>
                </div>

                <div class="items-center justify-end ml-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">Cancelar evento</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    const textarea = document.getElementById('justify');
    const counter = document.getElementById('char-count-justify');

    textarea.addEventListener('input', function () {
        const maxLength = parseInt(textarea.getAttribute('maxlength'), 10);
        const currentLength = textarea.value.length;

        if (currentLength > maxLength) {
            textarea.value = textarea.value.substring(0, maxLength);
        }

        counter.textContent = `${currentLength}/${maxLength}`;
    });
</script>