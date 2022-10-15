#INSTALACION 
### Creación del proyecto
curl -s https://laravel.build/impresiones_back | bash

### Configuración de git
git config core.filemode false

### Configuración de VSCODE
Instalar la extensión Remote Development by Microsoft

### Al trabajar con Sail
Debemos anteponer a todos los comandos: ./vendor/bin/sail

### Instalación de Laravel Modules
composer require nwidart/laravel-modules
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"

### Instalación de Laravel Telescope
composer require laravel/telescope --dev
php artisan telescope:install

### Instalacion de Legacy Factories
composer require laravel/legacy-factories

### Instalacion de Swagger
composer require "darkaonline/l5-swagger"
php artisan vendor:publish --provider "L5Swagger\L5SwaggerServiceProvider"
php artisan l5-swagger:generate         // correr cuando hubiera cambios en las anotaciones

### Instalacion Spatie/laravel-permissions
* composer require spatie/laravel-permission
* registrar en config/app.php de providers "Spatie\Permission\PermissionServiceProvider::class,"
* php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"
* 

### CONFIGURACION DEL SERVIDOR
* Configurar CronJob ==>  * * * * * cd /ruta_local_al_proyecto && php artisan schedule:run >> /dev/null 2>&1

------------------------------
----------------------
# NOTAS DE PROYECTO
### .ENV CONFIGURACIÓN
* IGNORE_TOKEN=true // Desabilita autenticacion por token. 
* IGNORE_PERMISOS=true  // Desabilita verificacion de permisos.

### Modulos
* api.php Hay que envolver todas las rutas con el middleware "auth:sanctum"

### Permisos
* para el modulo de permisos se utiliza la libreria de Spatie laravel/permissions
* los permisos se dan de alta automaticamente en la ruta "api/v1/auth/generatePermissionsRoles" y se asignan a un rol "Administrador" automaticamente
* los permisos siguen la siguiente estructura "modulo.controller.action"


