<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Editar Evento') }}
        </h2>

        {{-- Código para el manejo de notificaciones --}}
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-200 text-red-800 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
            <p>Ingresa toda la información de tu evento, en caso de que se requiera realizar el registro, escribe la URL de la herramienta de registro.</p>        
        </div>
    </x-slot>

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

    <div class="bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 max-w-7xl mx-auto sm:px-6 lg:px-8 overflow-hidden shadow-sm sm:rounded-lg">
            
        <form action="{{ route('event.update', ['event' => $event->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                @if ($event->space_required)
                    <h2 class="block font-bold mb-2">Espacio solicitado:
                        <span class="text-gray-700 dark:text-gray-300">
                            @foreach($event->spaces as $space)
                                {{ $space->name }} <br>
                            @endforeach
                        </span>
                    </h2>
                @else
                    <h2 class="block font-bold mb-2">Espacio solicitado: <span class="text-gray-500 dark:text-gray-300">Evento virtual</span>.</h2>
                @endif                            
            </div>

            <div class="mb-4 block">
                <strong>Fecha o periodo:</strong> del {{$event->start_date}} al {{$event->end_date}}, de {{$event->start_time}} a {{$event->end_time}} horas.
            </div>


            <!-- Título -->
            <div class="mb-4 block">
                <strong>Título de evento:</strong> <span class="text-gray-700 dark:text-gray-200">{{$event->title}}.</span>
            </div>

            <!-- Responsable -->
            <div class="mb-4 block">
                <strong>Responsable:</strong> <span class="text-gray-700 dark:text-gray-200">{{$event->responsible->name}}.</span>
            </div>

            <!-- Coresponsable -->
            <div class="mb-4 block">
                <strong>Co-responsable:</strong> <span class="text-gray-700 dark:text-gray-200">{{$event->coresponsible->name}}.</span>
            </div>

            <!-- Coresponsable -->
            <div class="mb-4 block">
                <strong>Resumen:</strong> <span class="text-gray-700 dark:text-gray-200">{{$event->summary}}.</span>
            </div>

            <!-- Coresponsable -->
            <div class="mb-4 block">
                @if($event->registration_url!=null)
                    <strong>Registro:</strong> <span class="text-gray-700 dark:text-gray-200">{{$event->registration_url}}</span>
                @else
                    <strong>No se requiere registro</strong>
                @endif
                </div>
            

            <!-- Banner del evento -->

            <div class="mb-4">
                <h2 class="font-bold">Banner o imagen publicitaria</h2>
                <img src="{{asset($event->cover_image)}}" alt="{{ $event->title }}" class="h-40 object-cover">
                <label for="cover_image" class="block mb-2">Si desea cambiar la imagen publicitaria, seleccione la nueva imagen.<span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Esta imagen será utilizada para mostrar en la cartelera, debe ser breve y atractiva para el público interesado. Solo se admiten los formatos .jpg, .jpeg y .png con un peso máximo de 5 MB">?</span></label>
                <input 
                    type="file" 
                    name="cover_image" 
                    id="cover_image"                                 
                    accept=".jpg, .jpeg, .png"
                    maxlength="5242880"
                    class="form-input dark:bg-gray-800 dark:text-white @error('cover_image') border-red-500 @enderror">
                @error('cover_image')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- Programa -->
            <h2 class="font-bold">Cartel o programa</h2>
            @if ($event->program)
                    <p><a href="{{ asset($event->program) }}" class="text-blue-600 hover:text-blue-900 underline" download>Descargar Programa</a></p>
            @endif
            <div class="mb-4">
                <label for="program" class="block mb-2">Para sustuir el Cartel o programa, seleccione el nuevo documento a subir.<span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Suba un documento con mayor información sobre el evento, puede ser un cartel o el programa. Solo se admite el formato pdf con un peso máximo de 5 MB">?</span></label>
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

            <div class="border p-4 border-gray-800 dark:border-gray-300">
                <b>Nota:</b> Si requiere servicio de grabación, fotografia o transmisión, por favor acuda directamente a UDEMAT para solicitar el servicio.
            </div>
            
            <div class="flex mb-2">
                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">Actualizar información del Evento</button>
                </div>

                <div class="flex items-center justify-end mt-4 ml-4">
                    <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md">Cancelar registro</a>
                </div>
            </div>
        </form>
        
    </div>
</x-app-layout>

<script>
    tippy('[data-tippy-content]');
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





