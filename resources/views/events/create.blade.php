<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Evento') }}
        </h2>
        <div class="text-gray-600 mb-2">
            <p>Ingresa toda la informacíón de tu evento, en caso de que se requiera realizar el registro, escribe la URL del herraemienta de registro.</p>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Título:</label>
                            <input type="text" name="title" id="title" class="form-input @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
                            @error('title')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="summary" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Resumen:</label>
                            <textarea name="summary" id="summary" class="form-textarea @error('summary') border-red-500 @enderror" required>{{ old('summary') }}</textarea>
                            @error('summary')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha de inicio:</label>
                            <input type="date" name="start_date" id="start_date" class="form-input @error('start_date') border-red-500 @enderror" value="{{ old('start_date') }}" min="{{ now()->addDays(4)->format('Y-m-d') }}" required>
                            @error('start_date')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha de fin:</label>
                            <input type="date" name="end_date" id="end_date" class="form-input @error('end_date') border-red-500 @enderror" value="{{ old('end_date') }}" min="{{ now()->addDays(4)->format('Y-m-d') }}" required>
                            @error('end_date')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="start_time" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Hora de inicio: <span class="text-sm">(en formato de 24 horas y a partir de las 7:00 horas)</span></label>
                            <input type="time" name="start_time" id="start_time" class="form-input @error('start_time') border-red-500 @enderror" value="{{ old('start_time') }}" min="07:00" max="21:00" step="1800" required>
                            @error('start_time')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="end_time" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Hora de fin:<span class="text-sm">(en formato de 24 horas y hasta las 21:00)</span></label>
                            <input type="time" name="end_time" id="end_time" class="form-input @error('end_time') border-red-500 @enderror" value="{{ old('end_time') }}" min="07:00" max="21:00" step="1800" required>
                            @error('end_time')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cover_image" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Imagen de portada:</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-input @error('cover_image') border-red-500 @enderror" required>
                            @error('cover_image')
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
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
                        </div>

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
                                <a href="{{ route('events.my-events') }}" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md">Cancelar registro</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
