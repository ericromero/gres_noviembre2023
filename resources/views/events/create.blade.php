<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Evento') }}
        </h2>

        {{-- Código para el manejo de notificaciones --}}
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="text-gray-600 mb-2">
            <p>Ingresa toda la información de tu evento, en caso de que se requiera realizar el registro, escribe la URL del herramienta de registro.</p>
            
                <form action="{{ route('users.altaAcademicoPre') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="space" value="{{$space->id}}">
                    <input type="hidden" name="start_date" value="{{$start_date}}">
                    <input type="hidden" name="end_date" value="{{$end_date}}">
                    <input type="hidden" name="start_time" value="{{$start_time}}">
                    <input type="hidden" name="end_time" value="{{$end_time}}">
                    En caso de que el o la académica no esté en lista, puedes agregarle dando clic aquí <button type="submit" class="text-orange-500 hover:underline">Dar de alta a un académico(a).
                </form>
            
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-2">
                            @if (isset($space)&&$space->name!=null)
                                <h2 class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Espacio solicitado: {{$space->name}}</h2>
                                <input name="space" type="hidden" value="{{$space->id}}">
                            @else
                                <h2 class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Espacio solicitado: Evento virtual.</h2>
                            @endif                            
                        </div>

                        <div class="mb-4 block text-gray-700 dark:text-gray-300 font-bold mb-2"">
                            Fecha o periodo: del {{$start_date}} al {{$end_date}}, de {{$start_time}} a {{$end_time}} horas.
                        </div>

                        <div class="mb-4">
                            <label for="department" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Departamento solicitante:</label>
                            <select name="department" id="department" class="form-select @error('department') border-red-500 @enderror" required>
                                <option value="">Seleccionar tipo de evento</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('event_type_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="event_type_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Tipo de Evento:</label>
                            <select name="event_type_id" id="event_type_id" class="form-select @error('event_type_id') border-red-500 @enderror" required>
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
                            <label for="title" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Título:</label>
                            <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
                            @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="responsable" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Responsable:</label>
                            <select name="responsable" id="responsable" class="form-select" required>
                                <option value="">Seleccionar responsable</option>
                                @foreach($academicos as $academico)
                                    <option value="{{ $academico->id }}">{{ $academico->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="corresponsable" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Corresponsable:</label>
                            <select name="corresponsable" id="corresponsable" class="form-select" required>
                                <option value="">Seleccionar corresponsable</option>
                                @foreach($academicos as $academico)
                                    <option value="{{ $academico->id }}">{{ $academico->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="mb-4">
                            <label for="summary" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Resumen:</label>
                            <textarea name="summary" id="summary" class="form-textarea @error('summary') border-red-500 @enderror" required>{{ old('summary') }}</textarea>
                            @error('summary')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex">
                            <div>
                                {{-- <label for="start_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha de inicio:</label> --}}
                                <input type="hidden" name="start_date" id="start_date" class="form-input @error('start_date') border-red-500 @enderror" value="{{ $start_date}}" min="{{ now()->addDays(4)->format('Y-m-d') }}" max="{{ now()->addMonths(6)->format('Y-m-d') }}" required>
                                @error('start_date')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="ml-4">
                                {{-- <label for="end_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha de fin:</label> --}}
                                <input type="hidden" name="end_date" id="end_date" class="form-input @error('end_date') border-red-500 @enderror" value="{{$end_date}}" min="{{ now()->addDays(4)->format('Y-m-d') }}" max="{{ now()->addMonths(6)->format('Y-m-d') }}" required>
                                @error('end_date')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex">
                            <div>
                                {{-- <label for="start_time" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Inicio:</label> --}}
                                <input type="hidden" name="start_time" id="start_time" class="form-input @error('start_time') border-red-500 @enderror" value="{{$start_time}}" required readonly>
                                @error('start_time')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="ml-4">
                                {{-- <label for="end_time" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Término:</label> --}}
                                <input type="hidden" name="end_time" id="end_time" class="form-input @error('end_time') border-red-500 @enderror" value="{{$end_time}}" required readonly>
                                @error('end_time')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="cover_image" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Imagen de portada:</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-input @error('cover_image') border-red-500 @enderror" required>
                            @error('cover_image')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="program" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Programa (PDF):</label>
                            <input type="file" name="program" id="program" class="form-input @error('program') border-red-500 @enderror">
                            @error('program')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- <div class="mb-4">
                            <label for="space_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Espacio:</label>
                            <select name="space_id" id="space_id" class="form-select @error('space_id') border-red-500 @enderror" required>
                                <option value="">Seleccionar espacio</option>
                                @foreach($spaces as $space)
                                    <option value="{{ $space->id }}">{{ $space->name }}</option>
                                @endforeach
                            </select>
                            @error('space_id')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div> --}}

                        <div class="mb-4">
                            <label for="requires_registration" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Requiere Registro:</label>
                            <input type="checkbox" name="requires_registration" id="requires_registration" class="form-checkbox" {{ old('requires_registration') ? 'checked' : '' }}>
                        </div>
                        
                        <div id="registration_url_container" class="mb-4 hidden">
                            <label for="registration_url" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">URL de Registro: <span class="text-sm">(Anotala URL comenzado con http)</span></label>
                            <input type="text" name="registration_url" id="registration_url" class="form-input @error('registration_url') border-red-500 @enderror" value="{{ old('registration_url') }}">
                            @error('registration_url')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="transmission_required" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Requiere transmisión:</label>
                            <input type="checkbox" name="transmission_required" class="form-checkbox">
                        </div>
                        
                        <div class="mb-4">
                            <label for="recording_required" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Requiere grabación:</label>
                            <input type="checkbox" name="recording_required" class="form-checkbox">
                        </div>
                        
                        <script>
                            const requiresRegistrationCheckbox = document.getElementById('requires_registration');
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
