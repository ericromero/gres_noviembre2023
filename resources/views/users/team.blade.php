<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold leading-tight bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
            {{ __('Equipo de trabajo') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">

        {{-- Código para el manejo de notificaciones --}}
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-4 mb-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-200 text-red-800 p-4 mb-4 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Número de trabajador
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Correo Electrónico
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Adscripción(es)
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">
                        Rol(es)
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Acciones</span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-700 dark:divide-gray-200">
                @foreach ($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->doi }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->degree }} {{ $user->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $user->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($user->adscriptions as $adscription)
                                {{ $adscription->department->name }}<br>
                            @endforeach
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @foreach ($user->roles as $role)
                                {{ $role->name }}<br>
                            @endforeach
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('users.removeTeam', ['team' => $user->team->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas quitar a este usuario del equipo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-indigo-500 hover:text-indigo-900 dark:text-indigo-300 dark:hover:text-indigo-500">Quitar</button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>                
    
        <div>
            <a href="{{ route('users.createUserTeam') }}" class="block mb-4 text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 inline-block">Agregar usuario al equipo</a>
            <a href="{{ route('dashboard') }}" class="block mb-4 text-center ml-2 px-6 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 inline-block">Regresar</a>
        </div>

    </div>
</x-app-layout>
