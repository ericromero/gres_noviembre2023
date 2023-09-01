<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo usuario')}}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('users.storePreEvent') }}" method="POST">
                        @csrf
                        <input type="hidden" name="space" value="{{$space}}">
                        <input type="hidden" name="start_date" value="{{$start_date}}">
                        <input type="hidden" name="end_date" value="{{$end_date}}">
                        <input type="hidden" name="start_time" value="{{$start_time}}">
                        <input type="hidden" name="end_time" value="{{$end_time}}">
                        <h3 class="font-bold text-lg mb-4">Ingresa la información del usuario a crear. La contraseña se genera de manera automática y se envía por correo electrónico.</h3>
                        
                        <div class="mb-4">
                            <label for="degree" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Grado académico actual:</label>
                            <select name="degree" id="degree" class="form-input" required>
                                <option value="C." {{ old('degree') === 'C.' ? 'selected' : '' }}>C.</option>
                                <option value="Sra." {{ old('degree') === 'Sra.' ? 'selected' : '' }}>Sra.</option>
                                <option value="Sr." {{ old('degree') === 'Sr.' ? 'selected' : '' }}>Sr.</option>
                                <option value="Lic." {{ old('degree') === 'Lic.' ? 'selected' : '' }}>Lic</option>
                                <option value="Mtra." {{ old('degree') === 'Mtra.' ? 'selected' : '' }}>Mtra.</option>
                                <option value="Mtro." {{ old('degree') === 'Mtro.' ? 'selected' : '' }}>Mtro.</option>
                                <option value="Dra." {{ old('degree') === 'Dra.' ? 'selected' : '' }}>Dra.</option>
                                <option value="Dr." {{ old('degree') === 'Dr.' ? 'selected' : '' }}>Dr.</option>
                            </select>
                            @error('degree')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div> 
                        
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Nombre completo: <span class="text-sm">(Comenzando por nombre y después apellidos).</span></label>
                            <input type="name" name="name" id="name" value="{{ old('name') }}" class="form-input" required>
                            @error('name')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>     

                        <div class="mb-4">
                            <label for="doi" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Número de trabajador</label>
                            <input type="doi" name="doi" id="doi" value="{{ old('doi') }}" class="form-input" required>
                            @error('doi')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>     

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Correo electrónico:</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-input" required>
                            @error('email')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div class="mb-4">
                            <select name="department" id="department" class="form-control" required>
                                <option value="">Seleccione un departamento</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>                            
                            @error('department')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">Crear usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
