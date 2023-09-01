<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Búsqueda de espacio') }}
        </h2>
        <div class="text-gray-600 mb-2">
            <p>Si para llevar a cabo tu evento requeries hacer uso de un espacio físico, ingresa las características de tu evento para verificar la disponibilidad de espacios.</p>
            <p>Si tu evento se realizará en la modalidad virtual, puedes omitir el buscador y continuar con el registro del evento.</p>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('spaces.search') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <table class="border-separate border-spacing-x-2 border border-slate-400">
                                <tr>
                                    <th><label for="start_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha de inicio</label></th>
                                    <th><label for="end_date" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Fecha de fin</label></th>
                                    <th><label for="start_time" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Hora de inicio</label></th>
                                    <th><label for="end_time" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Hora de termino</label></th>
                                    <th></th>
                                    
                                </tr>
                                <tr>
                                    <td><input type="date" name="start_date" min="{{ now()->addDays(4)->format('Y-m-d') }}" max="{{ now()->addMonths(6)->format('Y-m-d') }}" required></td>
                                    <td><input type="date" name="end_date" min="{{ now()->addDays(4)->format('Y-m-d') }}" max="{{ now()->addMonths(6)->format('Y-m-d') }}" required></td>
                                    <td><input type="time" name="start_time" required></td>
                                    <td><input type="time" name="end_time" required></td>
                                    <td><button class="block mb-4 text-center px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 inline-block" type="submit">Buscar disponibilidad</button></td>
                                    {{-- <td><a href={{route('events.create')}} class="block mb-4 text-center px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 inline-block">Mi evento es en línea</a></td> --}}
                                </tr>
                            </table>
                        </div>
                        {{-- <div class="mt-2">
                            <a href={{route('events.create')}} class="block ml-4 mb-4 text-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 inline-block" >Continuar</a>
                        </div> --}}
                    </form>
                    
                    @if(isset($availableSpaces))
                        <div class="py-4">
                            <h2>A continuación se muestran los espacios disponibles, si alguno de ellos se adecúa a tus requerimientos, da clic en Seleccionar este espacio para continuar con el registro.</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($availableSpaces as $space)
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-lg">
                                    <img src="{{ asset($space->photography) }}" alt="Imagen del espacio" class="w-full h-40 object-cover">
                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold">{{ $space->name }}</h3>
                                    </div>
                                    <div class="p-4 border-t dark:border-gray-700">
                                        <p class="text-gray-600">Capacidad: {{ $space->capacity }} personas</p>
                                        <p class="text-gray-600">Ubicación: {{ $space->location }}</p>
                                    </div>
                                    <div class="px-4 pb-4">
                                        {{-- <a href={{route('events.createwithSpace',$space->id,$start_date,$end_date)}} class="pb-2 text-green-500 hover:underline">Seleccionar este espacio</a> --}}
                                        <form action="{{ route('events.createwithSpace') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="space" value="{{$space->id}}">
                                            <input type="hidden" name="start_date" value="{{$start_date}}">
                                            <input type="hidden" name="end_date" value="{{$end_date}}">
                                            <input type="hidden" name="start_time" value="{{$start_time}}">
                                            <input type="hidden" name="end_time" value="{{$end_time}}">
                                            <button class="block mb-4 text-center px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 inline-block" type="submit">Seleccionar este espacio</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h2>No hay espacios disponibles, es necesario buscar otra fecha y/o horario o bien realizarlo de manera virtual.</h2>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
