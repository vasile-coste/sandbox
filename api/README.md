# Install
* composer install
* npm install
* composer dump-autoload
* php artisan make:model < name >, optional add `-m` to create migration table 
* php artisan migrate (create tables, require for nova)
* composer update --prefer-dist (for nova)
* php artisan nova:install
* php artisan nova:user (create nova user)
* add in config/app.php `App\Providers\NovaServiceProvider::class,` in `providers` array then access web with <app_url>/nova
* php artisan db:seed