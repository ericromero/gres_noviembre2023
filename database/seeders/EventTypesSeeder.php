<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventType;

class EventTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $eventTypes = [
            [
                'name' => 'Actividad literaria (incluye lectura literaria)',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Actividad multidisciplinaria',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Cápsula',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Ceremonia',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Certamen',
                'event_category_id' => 4,
            ],
            [
                'name' => 'Clase',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Club de conversación',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Coloquio',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Concurso',
                'event_category_id' => 4,
            ],
            [
                'name' => 'Conferencia y/o videoconferencia',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Congreso',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Conversatorio',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Curaduría',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Curso',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Develación de placa',
                'event_category_id' => 4,
            ],
            [
                'name' => 'Diplomado',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Encuentro',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Exposición',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Feria',
                'event_category_id' => 4,
            ],
            [
                'name' => 'Festival',
                'event_category_id' => 4,
            ],
            [
                'name' => 'Foro',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Función de concierto',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Función de obra de teatro',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Función de obra de danza',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Función de obra fílmica y video',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Homenaje',
                'event_category_id' => 4,
            ],
            [
                'name' => 'Jornada',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Mesa de venta',
                'event_category_id' => 4,
            ],
            [
                'name' => 'Mesa redonda',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Muestra',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Performance',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Premio y/o distinción otorgado',
                'event_category_id' => 4,
            ],
            [
                'name' => 'Premio y/o distinción recibido',
                'event_category_id' => 4,
            ],
            [
                'name' => 'Presentación de publicación',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Recorrido virtual',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Residencia artística',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Semana temática',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Seminario',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Simposio',
                'event_category_id' => 2,
            ],
            [
                'name' => 'Taller',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Transmisión simultánea',
                'event_category_id' => 3,
            ],
            [
                'name' => 'Visita guiada y recorrido mediado',
                'event_category_id' => 4,
            ],
        ];
        

        foreach ($eventTypes as $eventType) {
            EventType::create($eventType);
        }
    }
}
