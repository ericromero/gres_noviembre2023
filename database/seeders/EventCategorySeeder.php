<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventCategory;


class EventCategorySeeder extends Seeder
{
    public function run()
    {
        EventCategory::create([
            'name' => 'Difusión',
            'description' => 'Acción o conjunto de acciones que permiten extender o propagar información de toda índole a través de medios impresos, masivos de comunicación, electrónicos y digitales, dirigidas al público en general.'
        ]);

        EventCategory::create([
            'name' => 'Divulgación',
            'description' => 'Corresponde a aquellos eventos o actos de reflexión, análisis y transmisión de conocimientos y/o de la opinión de los universitarios con respecto a diversas problemáticas. Incluye: coloquios, conferencias, congresos, encuentros, foros, jornadas, mesas redondas, semanas y simposios.'
        ]);

        EventCategory::create([
            'name' => 'Extensión',
            'description' => 'Se refiere a los eventos y actividades de servicio, difusión, promoción y muestra de los resultados de la actividad creativa universitaria, o de aquellas actividades culturales importantes que la Universidad desea presentar como aporte a la sociedad en su conjunto. Incluye: conciertos, cursos, exposiciones, lecturas literarias, muestras, obras de danza, obras de teatro, obras fílmicas, performance/actividades multidisciplinarias, seminarios, talleres, proyección de videos y transmisiones (radio, TV).'
        ]);

        EventCategory::create([
            'name' => 'Vinculación',
                'description' => 'Son aquellas que se realizan para fomentar la participación y relación entre dependencias universitarias y de éstas con otras instituciones o empresas. Incluye: concursos, develaciones de placa, distinciones (otorgadas y recibidas), donaciones, ferias, festivales, homenajes, premios (otorgados y recibidos) y visitas guiadas.'
        ]);
        
    }
}
