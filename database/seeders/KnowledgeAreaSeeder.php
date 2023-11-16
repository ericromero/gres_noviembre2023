<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KnowledgeArea;

class KnowledgeAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $areas = [
            [
                'name' => 'Ciencias Físico-Matemáticas y de las Ingenierías',
                'description' => 'Rama o campo de estudio de las Ciencias Físico-Matemáticas y de las Ingenierías, sobre las cuales se realizan la docencia y la investigación. Incluye, Actuaría, Arquitectura, Arquitectura de Paisaje, Ciencia de Datos, Ciencia de Materiales Sustentables, Ciencias de la Computación, Ciencias de la Tierra, Diseño Industrial, Física, Física Biomédica, Geociencias, Ingeniería Aeroespacial, Ingeniería Ambiental, Matemáticas, Matemáticas Aplicadas, Matemáticas Aplicadas y Computación, Nanotecnología, Tecnología, Tecnologías para la Información en Ciencias, Urbanismo, Ingeniería: Civil, de Minas y Metalurgia, Eléctrica Electrónica, en Computación, en Energías Renovables, en Sistemas Biomédicos, en Telecomunicaciones, en Telecomunicaciones, Sistemas y Electrónica, Geofísica, Geológica, Geomática, Industrial, Mecánica, Mecánica Eléctrica, Mecatrónica, Petrolera, Química, Química Metalúrgica.'
            ],
            [
                'name' => 'Ciencias Biológicas y de la Salud',
                'description' => 'Rama o campo de estudio de las Ciencias Biológicas y de la Salud, sobre las cuales se realizan la docencia y la investigación. Incluye, Biología, Bioquímica Diagnóstica, Ciencia Forense, Ciencias Agroforestales, Ciencias Agrogenómicas, Ciencias Ambientales, Ciencias Genómicas, Cirujano Dentista, Ecología, Enfermería, Enfermería y Obstetricia, Farmacia, Fisioterapia, Ingeniería Agrícola, Ingeniería en Alimentos, Investigación Biomédica Básica, Manejo Sustentable de Zonas Costeras, Médico Cirujano, Medicina Veterinaria y Zootecnia, Neurociencias, Nutriología, Odontología, Optometría, Órtesis y Prótesis, Psicología, Química, Química de Alimentos, Química e Ingeniería en Materiales, Química Farmacéutico Biológica, Química Industrial.'
            ],
            [
                'name' => 'Ciencias Sociales',
                'description' => 'Rama o campo de estudio de las Ciencias Sociales. Incluye, Administración, Administración Agropecuaria, Antropología, Ciencias de la Comunicación, Ciencias Políticas y Administración Pública, Comunicación, Comunicación y Periodismo, Contaduría, Derecho, Desarrollo Comunitario para el Envejecimiento, Desarrollo Territorial, Economía, Economía Industrial, Estudios Sociales y Gestión Local, Geografía, Geografía Aplicada, Informática, Negocios Internacionales, Planificación para el Desarrollo Agropecuario, Relaciones Internacionales, Sociología, Trabajo Social.'
            ],
            [
                'name' => 'Humanidades y de las Artes',
                'description' => 'Rama o campo de estudio de las Humanidades y de las Artes. Incluye, Administración de Archivos y Gestión Documental, Arte y Diseño, Artes Visuales, Bibliotecología y Estudios de la Información, Cinematografía, Desarrollo y Gestión Interculturales, Diseño Gráfico, Diseño y Comunicación Visual, Enseñanza como Lengua Extranjerade de: Alemán, Español, Francés, Inglés e Italiano, Enseñanza de Inglés, Estudios Latinoamericanos, Etnomusicología, Filosofía, Geohistoria, Historia, Historia del Arte, Lengua y Literaturas Hispánicas, Lengua y Literaturas Modernas (Letras Alemanas, Francesas, Inglesas, Italianas o Portuguesas), Letras Clásicas, Lingüística Aplicada, Literatura Dramática y Teatro, Literatura Intercultural, Música - Canto, Música - Composición, Música - Educación Musical, Música - Instrumentista, Música - Piano, Música y Tecnología Artística, Pedagogía, Teatro y Actuación, Traducción.'
            ],
            [
                'name' => 'Multidisciplinaria',
                'description' => 'Es la interacción entre disciplinas que atienden un objeto común de estudio o problema pero que no requiere de la colaboración entre las disciplinas participantes, cada una aporta desde sus capacidades los conocimientos sobre dicho objeto.'
            ],
        ];

        foreach ($areas as $area) {
            KnowledgeArea::create($area);
        }
    }
}
