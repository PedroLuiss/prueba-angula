

## Instalación del proyecto API de Laravel

1. Navegue en la carpeta de su proyecto API de Laravel: `cd api`
2. Instalar dependencias del proyecto: `composer install`
3. Crea un nuevo archivo .env: `cp .env.example .env`
4. Agregue sus propias credenciales de base de datos en el archivo .env en DB_DATABASE, DB_USERNAME, DB_PASSWORD
5. Crear tabla de usuarios: `php artisan migrate --seed`
6. Generar clave de aplicación: `php artisan key:generate`
7. Install Laravel Passport: `php artisan passport:install` and set in the .env file the CLIENT_ID and CLIENT_SECRET that you receive

## Credenciales para iniciar sesion

Email : admin@gmail.com
Password: admin123

## Instalación del proyecto del panel de interfaz de usuario De Angular

1. Navegue a la carpeta de su proyecto Angular: `cd client`
2. Install project dependencies: `npm install`



