<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Crear Nuevo Espacio') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
        <form action="{{ route('spaces.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="department_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Departamento o área responsable</label>
                <select name="department_id" id="department_id" class="form-select dark:bg-gray-800 dark:text-white js-example-basic-single @error('department_id') border-red-500 @enderror" required>
                    <option value="">Seleccionar departamento</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Nombre del Espacio:</label>
                <input type="text" name="name" id="name" class="form-input dark:bg-gray-800 dark:text-white @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="location" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Ubicación:</label>
                <input type="text" name="location" id="location" class="form-input dark:bg-gray-800 dark:text-white @error('location') border-red-500 @enderror" value="{{ old('location') }}" required>
                @error('location')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="capacity" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Capacidad: <span class="text-sm">(Mínimo 1, máximo 150)</span></label>
                <input type="number" name="capacity" id="capacity" class="form-input dark:bg-gray-800 dark:text-white @error('capacity') border-red-500 @enderror" value="{{ old('capacity') }}" required>
                @error('capacity')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="photography" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fotografía del Espacio:</label>
                <input type="file" name="photography" id="photography" class="form-input dark:bg-gray-800 dark:text-white @error('photography') border-red-500 @enderror" required>
                @error('photography')
                <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="p-4">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">Crear Espacio</button>
                <a href="{{ route('spaces.index') }}" class="px-4 py-2 ml-4 bg-red-500 text-white font-semibold rounded-md">Cancelar registro</a>
            </div>
        </form>
            
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>