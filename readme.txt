
composer require spatie/laravel-permission
*/config/app/*
Spatie\Permission\PermissionServiceProvider::class 

*/tokens/*
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

*/Instala la librería de edición de imágenes (Intervention)*/
composer require intervention/image
