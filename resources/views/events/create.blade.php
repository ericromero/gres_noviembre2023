<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Crear Evento') }}
        </h2>

        {{-- Código para el manejo de notificaciones --}}
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
            <p>Ingresa toda la información de tu evento, en caso de que se requiera realizar el registro, escribe la URL de la herramienta de registro.</p>        
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-2">
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            @if (isset($space)&&$space->name!=null)
                                <h2 class="block font-bold mb-2">Espacio solicitado: <span class="text-gray-500 dark:text-gray-300">{{$space->name}}</span></h2>
                                <input name="space" type="hidden" value="{{$space->id}}">
                            @else
                                <h2 class="block font-bold mb-2">Espacio solicitado: <span class="text-gray-500 dark:text-gray-300">Evento virtual</span>.</h2>
                            @endif                            
                        </div>

                        <div class="mb-4 block font-bold mb-2">
                            Fecha o periodo: del {{$start_date}} al {{$end_date}}, de {{$start_time}} a {{$end_time}} horas.
                        </div>

                        <div class="mb-4">
                            <label for="department" class="block font-bold mb-2">Departamento solicitante: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Selecciona el departamento del cual solicitas el evento.">?</span></label>
                            <select name="department" id="department" class="js-example-basic-single form-select dark:bg-gray-800 dark:text-white @error('department') border-red-500 @enderror" required>
                                <option value="">Selecciona el departamento solicitante</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>                            
                            @error('department')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="event_type_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Tipo de Evento: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="En caso de no encontrar el tipo de Evento adecuado, selecciona Congreso y pide el ajuste al correo ericrm@unam.mx.">?</span></label>
                            <select name="event_type_id" id="event_type_id" class="js-example-basic-single dark:bg-gray-800 dark:text-white @error('event_type_id') border-red-500 @enderror" required>
                                <option value="">Seleccionar tipo de evento</option>
                                @foreach($eventTypes as $eventType)
                                    <option value="{{ $eventType->id }}">{{ $eventType->name }}</option>
                                @endforeach
                            </select>
                            @error('event_type_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="title" class="block dark:text-gray-300 font-bold mb-2">Título: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="No debe exceder los 250 caracteres incluyendo espacios en blanco.">?</span></label>                            
                            <input type="text" name="title" id="title" maxlength="250" class="w-full form-input dark:bg-gray-800 dark:text-white @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
                            
                            @error('title')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 dark:text-gray-300 text-sm">Caracteres restantes: <span id="char-count">250</span></p>
                        </div>

                        <div class="mb-4">
                            <label for="responsible" class="block font-bold mb-2">Responsable: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Selecciona al académico(a) que está organizando el evento y es responsable de realizar los trámites necesarios para llevarlo a cabo.">?</span></label>
                            <select name="responsible" id="responsible" class="js-example-basic-single dark:bg-gray-800 dark:text-white" required>
                                <option value="">Seleccionar responsable</option>
                                @foreach($academicos as $academico)
                                    <option value="{{ $academico->id }}">{{ $academico->name }}</option>
                                @endforeach
                            </select>
                            @error('responsible')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="coresponsible" class="block font-bold mb-2">Corresponsable: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="En caso de que el (la) responsable no pueda continuar con la organización del evento, el(la) corresponsable dará continuidad a la organización del evento.">?</span></label>
                            <select name="coresponsible" id="coresponsible" class="js-example-basic-single form-select dark:bg-gray-800 dark:text-white" required>
                                <option value="">Seleccionar corresponsable</option>
                                @foreach($academicos as $academico)
                                    <option value="{{ $academico->id }}">{{ $academico->name }}</option>
                                @endforeach
                            </select>
                            @error('corresponsible')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="summary" class="block font-bold mb-2">Resumen: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Agrega un resumen y/o información adicional para el público interesado en el evento, como máximo se admiten 500 caracteres.">?</span></label>
                            <textarea name="summary" id="summary" maxlength="500" rows="4" class="w-full form-textarea dark:bg-gray-800 dark:text-white @error('summary') border-red-500 @enderror" required>{{ old('summary') }}</textarea>
                            @error('summary')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 dark:text-gray-300 text-sm">Caracteres restantes: <span id="char-count-summary">500</span></p>
                        </div>

                        <div class="flex">
                            <div>
                                <input type="hidden" name="start_date" id="start_date" class="form-input @error('start_date') border-red-500 @enderror" value="{{ $start_date}}" min="{{ now()->addDays(4)->format('Y-m-d') }}" max="{{ now()->addMonths(6)->format('Y-m-d') }}" required>
                                @error('start_date')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="ml-4">
                                <input type="hidden" name="end_date" id="end_date" class="form-input @error('end_date') border-red-500 @enderror" value="{{$end_date}}" min="{{ now()->addDays(4)->format('Y-m-d') }}" max="{{ now()->addMonths(6)->format('Y-m-d') }}" required>
                                    @error('end_date')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex">
                            <div>
                                <input type="hidden" name="start_time" id="start_time" class="form-input @error('start_time') border-red-500 @enderror" value="{{$start_time}}" required readonly>
                                @error('start_time')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="ml-4">
                                <input type="hidden" name="end_time" id="end_time" class="form-input @error('end_time') border-red-500 @enderror" value="{{$end_time}}" required readonly>
                                @error('end_time')
                                    <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="cover_image" class="block font-bold mb-2">Banner o imagen publicitaria: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Esta imagen será utilizada para mostrar en la cartelera, debe ser breve y atractiva para el público interesado. Solo se admiten los formatos .jpg, .jpeg y .png con un peso máximo de 5 MB">?</span></label>
                            <input 
                                type="file" 
                                name="cover_image" 
                                id="cover_image"                                 
                                accept=".jpg, .jpeg, .png"
                                maxlength="5242880"
                                class="form-input dark:bg-gray-800 dark:text-white @error('cover_image') border-red-500 @enderror" required>
                            @error('cover_image')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="program" class="block font-bold mb-2">Cartel o programa: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Suba un documento con mayor información sobre el evento, puede ser un cartel o el programa. Solo se admite el formato pdf con un peso máximo de 5 MB">?</span></label>
                            <input
                                type="file"
                                name="program" 
                                id="program"
                                accept=".pdf"
                                maxlength="5242880"
                                class="form-input dark:bg-gray-800 dark:text-white @error('program') border-red-500 @enderror">
                            @error('program')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="registration_required" class="block font-bold mb-2">Requiere Registro: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Si requiere un registro de los asistentes al evento, active esta casilla y posteriormente escriba la URL del enlace web donde se pueden registrar los asistentes. Este sitio de registro debe ser gestionado por el responsable del evento.">?</span></label>
                            <input type="checkbox" name="registration_required" id="registration_required" class="form-checkbox" {{ old('registration_required') ? 'checked' : '' }}>
                            @error('registration_required')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div id="registration_url_container" class="mb-4 hidden">
                            <label for="registration_url" class="block font-bold mb-2">URL de Registro: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Escriba la URL del sitio de registro del sistema.">?</span></label>
                            <input type="text" name="registration_url" id="registration_url" class="form-input dark:bg-gray-800 dark:text-white @error('registration_url') border-red-500 @enderror" value="{{ old('registration_url') }}">
                            @error('registration_url')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror                            
                        </div>

                        <div class="mb-4">
                            <label for="transmission_required" class="block font-bold mb-2">Requiere transmisión: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Si requiere que su evento sea transmitido por los canales institucionales gestionados por UDEMAT, active esta casilla.">?</span></label>
                            <input type="checkbox" name="transmission_required" class="form-checkbox">
                            @error('transmission_required')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror                            
                        </div>
                        
                        <div class="mb-4">
                            <label for="recording_required" class="block font-bold mb-2">Requiere grabación: <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Si requiere que se lleve a cabo la grabación de su evento, active esta casilla.">?</span></label>
                            <input type="checkbox" name="recording_required" class="form-checkbox">
                            @error('recording_required')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex">
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">Registrar Evento</button>
                            </div>

                            <div class="flex items-center justify-end mt-4 ml-4">
                                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md">Cancelar registro</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<script>
    const requiresRegistrationCheckbox = document.getElementById('registration_required');
    const registrationUrlContainer = document.getElementById('registration_url_container');
    const registrationUrlInput = document.getElementById('registration_url');

    requiresRegistrationCheckbox.addEventListener('change', () => {
        if (requiresRegistrationCheckbox.checked) {
            registrationUrlContainer.classList.remove('hidden');
            registrationUrlInput.setAttribute('required', true);
        } else {
            registrationUrlContainer.classList.add('hidden');
            registrationUrlInput.removeAttribute('required');
        }
    });
</script>

<script>
    tippy('[data-tippy-content]');
</script>

<script>
    const titleInput = document.getElementById('title');
    const charCount = document.getElementById('char-count');

    titleInput.addEventListener('input', function() {
        charCount.textContent = 250 - titleInput.value.length;
    });
</script>

<script>
    const textarea = document.getElementById('summary');
    const counter = document.getElementById('char-count-summary');

    textarea.addEventListener('input', function () {
        const maxLength = parseInt(textarea.getAttribute('maxlength'), 10);
        const currentLength = textarea.value.length;

        if (currentLength > maxLength) {
            textarea.value = textarea.value.substring(0, maxLength);
        }

        counter.textContent = `${currentLength}/${maxLength}`;
    });
</script>

<script>
    const fileInput = document.getElementById('cover_image');
    const maxSize = 5242880; // Tamaño máximo en bytes (5 MB)

    fileInput.addEventListener('change', function () {
        const allowedFormats = ['image/jpeg', 'image/png', 'image/jpg'];
        const selectedFile = this.files[0];

        if (!selectedFile) {
            return; // No se seleccionó ningún archivo
        }

        const selectedFileType = selectedFile.type;
        const selectedFileSize = selectedFile.size;

        if (!allowedFormats.includes(selectedFileType)) {
            alert('Por favor, seleccione un archivo de tipo .jpg, .jpeg o .png.');
            this.value = ''; // Limpia el valor del input para permitir una nueva selección
            return;
        }

        if (selectedFileSize > maxSize) {
            alert('El archivo seleccionado es demasiado grande. El tamaño máximo permitido es de 5 MB.');
            this.value = ''; // Limpia el valor del input para permitir una nueva selección
        }
    });
</script>

<script>
    const fileInput = document.getElementById('program');
    const maxSize = 5242880; // Tamaño máximo en bytes (5 MB)

    fileInput.addEventListener('change', function () {
        const allowedFormat = 'application/pdf';
        const selectedFile = this.files[0];

        if (!selectedFile) {
            return; // No se seleccionó ningún archivo
        }

        const selectedFileType = selectedFile.type;
        const selectedFileSize = selectedFile.size;

        if (selectedFileType !== allowedFormat) {
            alert('Por favor, seleccione un archivo en formato PDF.');
            this.value = ''; // Limpia el valor del input para permitir una nueva selección
            return;
        }

        if (selectedFileSize > maxSize) {
            alert('El archivo seleccionado es demasiado grande. El tamaño máximo permitido es de 5 MB.');
            this.value = ''; // Limpia el valor del input para permitir una nueva selección
        }
    });
</script>


