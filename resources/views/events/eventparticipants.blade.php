<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Registro de participantes') }}
        </h2>
        <div class="text-gray-700 dark:text-gray-300">
            Si el participante es académico(a) de la Facutad de Psicología, búscalo en el apartado "Registro de académico(a) de la Facultad de Psicología", caso contrario, regístralo en el apartado "registro de académico(a) externo".
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300">

        {{-- Código para el manejo de notificaciones --}}
        @if(isset($message))
            <div class="{{ isset($academico) ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }} p-4 mb-4 rounded-md">
                {{ $message }}
            </div>
        @endif
        
        <div class="grid sm:grid-cols-1 lg:grid-cols-2 gap-2 mx-auto sm:px-2 lg:px-2">
            <!-- Campo de búsqueda para el usuario por DOI -->
            <div class="p-2 border border-gray-700 dark:border-gray-300">
                <h2 class="text-lg border-b border-gray-700 dark:border-gray-500">Registro de académico(a) de la Facultad de Psicología</h2>
                <form action="{{ route('eventparticipant.storeparticipant') }}" method="POST" class="space-y-4">
                    @csrf
                    <label for="fullname" class="block font-bold mb-2">Nombre del académico(a)
                        <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Busca al académico(a) de la Facultad de Psicología escribiendo su nombre y apellidos.">?</span>
                    </label>
                    <select class="js-example-basic-single dark:bg-gray-800 dark:text-white" name="fullname" id="fullname" placeholder="Nombre del académico(a)" required>
                        <option>Selecciona un académico</option>
                        @foreach ($academics as $academic)
                            <option value="{{$academic->name}}">{{$academic->name}}</option>
                        @endforeach
                    </select>
                    
                    <!-- Selección del tipo de participante -->
                    <label for="participation_type_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Tipo de Participante:</label>
                    <select name="participation_type_id" id="participation_type_id" class="dark:bg-gray-800 dark:text-white">
                        <option value="">Seleccionar tipo de participación</option>
                        @foreach($participationTypes as $participationType)
                            <option value="{{ $participationType->id }}">{{ $participationType->name }}</option>
                        @endforeach
                    </select>

                    <!-- Campo oculto para el ID del evento -->
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <!-- Botón para registrar al participante -->
                    <div class="flex items-center">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">{{ __('Registrar participante de la Facultad') }}</button>
                    </div>

                </form>
            </div>
            

            <div class="p-2 ml-2 border border-gray-700 dark:border-gray-300">
                <h2 class="text-lg border-b border-gray-700 dark:border-gray-500">Registro de académico(a) externo.</h2>
                <form action="{{ route('eventparticipant.storeparticipant') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Campos para llenar en caso de que el usuario no exista en la base de datos -->    
                    <label for="fullname" class="block font-bold mb-2">Grado y nombre del académico(a)
                        <span class="px-1 text-gray-600 bg-gray-300 dark:text-gray-300 dark:bg-gray-600" data-tippy-content="Registra al académico(a) escribiendo su grado, nombre y apellidos.">?</span>
                    </label>
                    <input class="dark:bg-gray-800 dark:text-white" type="text" name="fullname" id="fullname" required/>

                    <!-- Selección del tipo de participante -->
                    <label for="participation_type_id" class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Tipo de Participante:</label>
                    <select name="participation_type_id" id="participation_type_id" class="dark:bg-gray-800 dark:text-white">
                        <option value="">Seleccionar tipo de participación</option>
                        @foreach($participationTypes as $participationType)
                            <option value="{{ $participationType->id }}">{{ $participationType->name }}</option>
                        @endforeach
                    </select>

                    <!-- Campo oculto para el ID del evento -->
                    <input type="hidden" name="event_id" value="{{ $event->id }}">

                    <!-- Botón para registrar al participante -->
                    <div class="flex items-center">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-md">{{ __('Registrar participante externo') }}</button>
                    </div>

                </form>
            </div>
        </div>

        <div class="p-6">
            <h2 class="text-lg font-semibold mb-2">Lista de Participantes</h2>
            <!-- Lista de participantes -->
            @if ($participants!=null&&$participants->count() > 0)
                <table class="border border-gray-700 dark:border-gray-300">
                    <thead class="bg-gray-300 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2">Nombre completo</th>
                            <th class="px-4 py-2">Tipo de participación</th>
                            <th class="px-4 py-2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($participants as $participant)
                            <tr>
                                <td class="px-4 py-2">
                                    @if($participant->user_id!=null)
                                        {{ $participant->user->degree }}
                                    @endif 
                                    {{ $participant->fullname }}
                                </td>
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

        <div class="flex mt-4 mb-4">
            <!-- Botón para cerrar el registro -->
            <a href="{{route('events.register',$event->id)}}" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md"
                onclick="return confirm('Una vez registrado el evento no podrá modificar la información primordial como lo es el título, fechas y espacio solicitado del evento. ¿Desea continuar?')">
                {{ __('Registrar evento') }}
            </a>
            <!-- Botón para cancelar registro -->
            <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                @csrf
                @method('DELETE')
                
                <button type="submit" class="px-4 py-2 ml-4 bg-red-500 text-white font-semibold rounded-md" onclick="return confirm('¿Estás seguro de que deseas cancelar este registro?')">
                    {{ __('Cancelar registro') }}
                </button>
            </form>
            
        </div>

    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<script>
    tippy('[data-tippy-content]');
</script>