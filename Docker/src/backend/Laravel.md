En el caso de nobara hacen falta estos paquetes ademas de php

sudo dnf install php-cli php-zip php-xml php-mbstring php-gd php-curl php-mysqlnd php-intl -y

composer create-project laravel/laravel laravel-crud-api  

php artisan serve

php artisan install:api

sudo docker exec -it php_app php artisan migrate

docker exec -it php_app php artisan route:list

docker exec -it php_app grep sanctum

docker exec -it php_app php artisan storage:link 
<!-- crear enlace simbolico -->