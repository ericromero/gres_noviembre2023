<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registro de participantes') }}
        </h2>
        <div class="text-gray-700 dark:text-gray-300">
            Si el participante es académico(a) de la Facutad de Psicología, búscalo por su número de trabajador y dando clic en "Buscar académico(a)", para ponentes externos ingresa su grado y nombre completo.
        </div>
    </x-slot>

    {{-- <div class="py-2"> --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">
            {{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> --}}
                {{-- <div class="p-6"> --}}

                    {{-- Código para el manejo de notificaciones --}}
                    @if(isset($message))
                        <div class="{{ isset($academico) ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }} p-4 mb-4 rounded-md">
                            {{ $message }}
                        </div>
                    @endif
                        
                    <!-- Campo de búsqueda para el usuario por DOI -->
                    <div class="p-2 border border-gray-700 dark:border-gray-300">
                        <form action="{{ route('event.searchparticipant') }}" method="POST" class="space-y-4">
                        @csrf
                        <label for="user_doi" class="block font-bold mb-2">Si el o la académica son de la Facultad de Psicología, busca su registro escribiendo su número de trabajador y dando clic en Buscar académico(a).</label>
                        <input class="dark:bg-gray-800 dark:text-white" type="text" name="user_doi" id="user_doi" placeholder="Número de trabajador" required/>
                        
                        <!-- Campo oculto para el ID del evento -->
                        <input type="hidden" name="event_id" value="{{ $event->id }}">

                        <button type="submit" class="text-orange-500 hover:underline">Buscar académico(a)</button>
                        </form>
                    </div>
                    

                    <div class="p-2 mt-2 border border-gray-700 dark:border-gray-300">
                        <form action="{{ route('eventparticipant.storeparticipant') }}" method="POST" class="space-y-4">
                            @csrf

                            <!-- Campos para llenar en caso de que el usuario no exista en la base de datos -->
                            <div>

                                <label for="fullname" class="block font-bold mb-2">Si el participante es externo a la Facultad de Psicología, escribe su Grado y Nombre completo:</label>
                                <input class="dark:bg-gray-800 dark:text-white" type="text" name="fullname" id="fullname"  
                                    @if(isset($academico)&&$academico!=null)
                                        value="{{$academico->degree}} {{$academico->name}}" readonly                       
                                    @endif />

                            </div>

                            <!-- Selección del tipo de participante -->
                            <div>
                                <label for="participation_type_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Tipo de Participante:</label>
                                <select name="participation_type_id" id="participation_type_id" class="dark:bg-gray-800 dark:text-white">
                                    <option value="">Seleccionar tipo de participante</option>
                                    @foreach($participationTypes as $participationType)
                                        <option value="{{ $participationType->id }}">{{ $participationType->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Campo oculto para el ID del evento -->
                            <input type="hidden" name="event_id" value="{{ $event->id }}">

                            <!-- Campo oculto para el DOi del usuario -->
                            @if(isset($academico)&&$academico!=null)
                                <input type="hidden" name="user_id" value="{{ $academico->id }}">
                            @endif

                            <!-- Botones -->
                            <div class="flex">
                                <!-- Botón para registrar al participante -->
                                <div class="flex items-center mx-4">
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">{{ __('Registrar Participante') }}</button>
                                </div>
                                
                                <!-- Botón para limpiar los campos -->
                                <div class="flex items-center mx-4">
                                    <a href="{{route('events.participants',$event->id)}}" class="px-4 py-2 bg-orange-500 text-white font-semibold rounded-md">{{ __('Limpiar campos') }}</a>
                                </div>

                                <!-- Botón para cerrar el registro -->
                                <div class="flex items-center mx-4">
                                    <a href="{{route('events.register',$event->id)}}" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md"
                                        onclick="return confirm('Una vez registrado el evento no podrá modificar la información o agregar participantes. ¿Desea continuar?')">
                                        {{ __('Registrar evento') }}
                                    </a>
                                </div>

                                <!-- Botón para cancelar registro -->
                                <div class="flex items-center mx-4">
                                    <a href="{{route('events.destroy',$event->id)}}" class="px-4 py-2 bg-red-500 text-white font-semibold rounded-md"
                                        onclick="return confirm('¿Estás seguro de que deseas cancelar este registro?')">
                                        {{ __('Cancelar registro') }}
                                    </a>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                {{-- </div> --}}

                <div class="p-6">
                    <h2 class="text-lg font-semibold mb-2">Lista de Participantes</h2>
                    <!-- Lista de participantes -->
                    @if ($participants!=null&&$participants->count() > 0)
                        <table class="min-w-full border border-gray-700 dark:border-gray-300">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Nombre completo</th>
                                    <th class="px-4 py-2">Tipo de participación</th>
                                    <th class="px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participants as $participant)
                                    <tr>
                                        <td class="px-4 py-2">{{ $participant->fullname }}</td>
                                        <td class="px-4 py-2">{{ $participant->participationType->name }}</td>
                                        <td class="px-4 py-2">
                                            <a href="{{ route('eventparticipant.delete', ['participant' => $participant->id]) }}"
                                            class="text-red-500"
                                            onclick="return confirm('¿Estás seguro de que deseas quitar a este participante?')">
                                                Quitar
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No hay participantes agregados al evento.</p>
                    @endif
                </div>
            {{-- </div> --}}
        </div>
    {{-- </div> --}}

</x-app-layout>
