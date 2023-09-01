<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Actualizar información')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="font-bold text-lg mb-4">{{$user->name}} ({{$user->doi}})</h3>
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="degree" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Grado académico actual: {{$user->degree}}</label>
                            <select name="degree" id="degree" class="form-input" required>
                                <option value="{{$user->degree}}" selected>{{ $user->degree }}</option>
                                <option value="C.">C.</option>
                                <option value="Sra.">Sra.</option>
                                <option value="Sr.">Sr.</option>
                                <option value="Lic.">Lic</option>
                                <option value="Mtra.">Mtra.</option>
                                <option value="Mtro.">Mtro.</option>
                                <option value="Dra.">Dra.</option>
                                <option value="Dr.">Dr.</option>
                            </select>
                        </div> 

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Correo electrónico:</label>
                            <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-input">
                        </div>                        

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-input" placeholder="Ingrese nueva contraseña">
                            @error('password')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Confirme la contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-input" placeholder="Confirme la contraseña">
                        </div>
                    
                        <div class="mb-4">
                            <label for="departments" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Departamentos de Adscripción:</label>
                            @foreach($departments as $department)
                                <label class="inline-flex items-center mt-1">
                                    <input type="checkbox" name="departments[]" value="{{ $department->id }}" {{ in_array($department->id, old('departments', $user->adscriptions->pluck('department_id')->toArray())) ? 'checked' : '' }} class="form-checkbox">
                                    <span class="ml-2">{{ $department->name }}</span>
                                </label>
                            @endforeach
                            @error('departments')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="roles" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Funciones del usuario</label>
                            @foreach($roles as $role)
                                <label class="inline-flex items-center mt-1">
                                    <input type="checkbox" name="roles[]" value="{{ $role->id }}" {{ in_array($role->id, old('roles', $user->roles->pluck('id')->toArray())) ? 'checked' : '' }} class="form-checkbox">
                                    <span class="ml-2">{{ $role->name }}</span>
                                </label>
                            @endforeach
                            @error('roles')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
