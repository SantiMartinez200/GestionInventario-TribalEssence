# Guía de Instalación de la Aplicación
## Requisitos Previos
Laragon con PHP 8.1.10

Node.js

Composser

## Pasos para la Instalación
### Paso 1: Instalar Composser
Descarga e instalar Composser desde [aquí.](https://getcomposer.org/)

### Paso 2: Instalar Laragon
Descarga e instala Laragon desde [aquí.](https://laragon.org/)

### Paso 3: Instalar Node.js
Descarga e instala Node.js desde [aquí.](https://nodejs.org/en)

### Paso 4: Descargar la Aplicación
Tienes dos opciones para obtener el código de la aplicación:

### Paso 5: Instalar Dependencias con Composer
Abre la terminal de Laragon.
Navega hasta la carpeta de la aplicación: ``cd C:\laragon\www\"nombre"``

Ejecuta el siguiente comando: ``composer install``

### Paso 6: Instalar los paquetes de dependencia de VITE
Abre la terminal de Laragon.
Navega hasta la carpeta de la aplicación: ```cd C:\laragon\www\"nombre"```

Ejecuta el siguiente comando: ``npm install``

### Paso 7: Configurar el archivo ENV
Dentro de la carpeta "nombre" copia el archivo .env.example y pégalo en el mismo lugar.

Renombra la copia a .env.

### Paso 8: Iniciar los Servidores
En tu terminal de preferencia, navega hasta la carpeta de la aplicación: ``cd C:\laragon\www\"nombre"``

Ejecuta los siguientes comandos para iniciar los servidores: ``php artisan serve``, ``npm run dev``

### Paso 9: Acceder a la Aplicación
Abre tu navegador web y ve a http://localhost:8000 para acceder a la aplicación.




> [!NOTE]
> Respetar las versiones de las aplicaciones.
