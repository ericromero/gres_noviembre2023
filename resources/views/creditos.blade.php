<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créditos') }}
        </h2>
        <p class="dark:bg-gray-800 text-gray-700 dark:text-gray-300">Desarrolladores del sistema.</p>
    </x-slot>

    
    <div class="py-2 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-4 grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3">
                
                <!-- Perfil de Eric Romero -->
                <div class="overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4 border border-gray-700 dark:border-gray-300">
                    {{-- <img src="" class="w-full h-40 object-cover"> --}}
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Mtro. Eric Romero Martínez</h2>
                        <p class="text-gray-500 dark:text-gray-300 mb-2">Líder de proyecto, ingeniería de software y programación.</p>
                        <p><strong>Correo electrónico:</strong> ericrm@unam.mx</p>
                    </div>                    
                </div>

                <!-- Perfil de Jorge Gold -->
                <div class="overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4 border border-gray-700 dark:border-gray-300">
                    {{-- <img src="" class="w-full h-40 object-cover"> --}}
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Ing. Jorge Enrique Gold Hernández</h2>
                        <p class="text-gray-500 dark:text-gray-300 mb-2">Ingeniería de software y programación</p>
                        <p><strong>Correo electrónico:</strong> jorgegold@gmail.com</p>
                    </div>                    
                </div>

                <!-- Perfil de Carlos García-->
                <div class="overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4 border border-gray-700 dark:border-gray-300">
                    {{-- <img src="" class="w-full h-40 object-cover"> --}}
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Mtro. Carlos García Arano</h2>
                        <p class="text-gray-500 dark:text-gray-300 mb-2">Pruebas y análisis de UX</p>
                    </div>                    
                </div>

            </div>

            <div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
                    <h2 class="text-xl font-semibold mb-2">Iconografía</h2>
                        <p class="mb-2">Las imágenes e iconos del sistema han sido tomados de <a href="https://www.freepik.es" target="_blank" class="text-blue-500 hover:underline">https://www.freepik.es</a></p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
