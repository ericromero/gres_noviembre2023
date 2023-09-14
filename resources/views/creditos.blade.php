<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créditos') }}
        </h2>
        <p class="dark:bg-gray-800 text-gray-700 dark:text-gray-300">Desarrolladores del sistema.</p>
    </x-slot>

    
    <div class="py-2 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid gap-4 grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                
                <!-- Perfil de Eric Romero -->
                <div class="overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
                    {{-- <img src="" class="w-full h-40 object-cover"> --}}
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Mtro. Eric Romero Martínez</h2>
                        <p class="text-gray-500 dark:text-gray-300 mb-2">Estudiante del Doctorado en Pedagogía en la Facultad de Filosofía y Letras de la UNAM, Maestro en Tecnología Educativa por la Universidad Autónoma del Estado de Hidalgo, Especialista en Entornos Virtuales de Aprendizaje por Virtual Educa, egresado de la Maestría en Ciencias e Ingeniería en Computación por el Posgrado en Ciencias e Ingeniería de la Compuptación de a UNAM y es Ingeniero en Computación por la Facultad de Ingeniería de la UNAM.
                            <br>Diplomados: "Administración de proyectos", "Aplicación de las TIC para la enseñanza" y "TIC para el desarrollo de habilidades digitales en el aula" por la UNAM.
                            <br>Certificaciones: Creador de cursos en Moodle (MCCC) y EC0336 Tutoría de cursos y diplomados en línea.
                            <br>Ponente, presencial y virtual en congresos y eventos nacionales e internacionales tanto dentro como fuera de la UNAM, siendo uno de ellos el MOODLE-MOOT México en 2015, cuyo evento es realizado a nivel internacional y siendo esta la primer y única vez que se ha realizado en México en la Ciudad de Guadalajara.
                            <br>Cuenta con 2 publicaciones arbitradas sobre el uso y diseño de portafolios eletcrónicos, así como haber colaborado en escribir 4 capítulos de libro.
                            <br>Evaluador de trabajos para participación en congresos y evaluador académico para artículos publicados en revistas científicas incorporados al sistema Scopus.
                            <br>Responsable de proyectos PAPIME y colaborador en PAPIME y PAPIIT</p>
                        <p><strong>Correo electrónico:</strong> ericrm@unam.mx</p>
                    </div>
                    
                </div>

                <!-- Perfil de Jorge Gold -->
                <div class="overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
                    {{-- <img src="" class="w-full h-40 object-cover"> --}}
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">Ing. Jorge Enrique Gold Hernández</h2>
                        <p class="text-gray-500 dark:text-gray-300 mb-2">Secretario Técnico de la División del Sistema Universidad Abierta de la Facultad de Psicología de la UNAM.
                            <br>Ingeniero en computación por la Facultad de Ingeniería de la Universidad Nacional Autónoma de México.
                            <br>Desarrollador Full-Stack developer con 14 años de experiencia.
                            <br>Programador .NET Xamarin avalado por Microsoft.
                            <br>Se ha desempeñado como consultor de desarrollo e implementación de modelos de negocio e integración con TIC en el sector privado. Ha desarrollado aplicaciones móviles y recursos tecnológicos para campañas de marketing.
                            <br>Ha participado en el desarrollo de materiales didácticos interactivos y diseño instruccional para cursos en línea con la Universidad Iberoamericana. Actualmente colabora en la administración de plataformas de e-Learning, impartición de cursos para alumnos y docentes, y creación de contenidos para enseñanza en línea en la Facultad de Psicología de la UNAM.</p>
                        <p><strong>Correo electrónico:</strong> jorgegold@gmail.com</p>
                    </div>
                    
                </div>

            </div>

            <div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden rounded-lg shadow-sm sm:rounded-lg mb-4">
                    <h2 class="text-xl font-semibold mb-2">Iconografía</h2>
                        <p class="text-gray-500 mb-2">Las imágenes e iconos del sistema han sido tomados de <a href="https://www.freepik.es" target="_blank" class="text-blue-500 hover:underline">https://www.freepik.es</a></p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
