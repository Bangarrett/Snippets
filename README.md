
getCode es una aplicación web desarrollada con el framework Laravel utilizando Laravel Sail y Tailwind CSS. La aplicación está diseñada para permitir a los usuarios subir y compartir su código con otros usuarios de la plataforma, los usuarios no registrados pueden explorar por la web de forma limitada. getCode ofrece una interfaz sencilla y amigable para crear y visualizar los diferentes snippets de codigo publicados.

## Características
* Gestión de cuentas de usuario: Los usuarios pueden crear una cuenta, iniciar sesión y gestionar su perfil.
* Subida de código: Los usuarios pueden subir archivos de código en diferentes lenguajes de programación.
* Resaltado de sintaxis: La aplicación resalta la sintaxis del código para facilitar su lectura y comprensión.
* Comentarios y valoraciones: Los usuarios pueden comentar y valorar el código compartido por otros usuarios.
* Búsqueda de usuarios: Los usuarios pueden buscar y filtrar por usuarios.
* Seguimiento de usuarios: Los usuarios pueden seguir a otros usuarios para recibir actualizaciones sobre su actividad y código compartido.

## Requisitos Previos
* PHP o Docker
* MySQL o XAMPP
* Composer o Docker
* Node.js
* NPM

  ## Instalación
1. Clona el repositorio de getCode:
git clone git@github.com:FF5-DW1/ej6_gusto.git
2. Accede al directorio del proyecto:
cd ej6_gusto
3. Instala las dependencias de PHP utilizando Composer:
composer install o composer update
4. Copia el archivo de configuración .env.example y renómbralo a .env. Luego, actualiza las variables de entorno segun tu base de datos en el archivo .env:
5. Genera una clave de aplicación:
php artisan key:generate
6. Ejecuta las migraciones y los seeders:
php artisan migrate --seed
7. Instala las dependencias de JavaScript:
npm install
8. Compila los assets de JavaScript y CSS:
npm run dev

## Fuentes
* Laravel: https://laravel.com
* Docker: https://www.docker.com
* Tailwind CSS: https://tailwindcss.com

## Desarrolladores
[Jesús Cabral](https://github.com/JesCab29)  

[Pablo Caballero](https://github.com/Khodac)  

[Alejandro Calquín](https://github.com/Bangarrett)
