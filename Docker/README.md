# Configuraciones Servicios Docker

## 0. Comandos inicio Docker:
* Instalar Docker
    ```bash
        sudo dnf install docker docker-compose
    ```
* Arrancar Docker
    ```bash
        sudo systemctl enable --now docker
    ```
* Arrancar Servicios docker-compose Docker
    ```bash
        sudo docker compose up -d
    ```
* Reconstruye y levanta:
    ```bash
        sudo docker compose up -d --build
    ```
* Permisos laravel (ruta docker-compose.yml)
    ```bash
        # Dar permisos de escritura a las carpetas que Laravel necesita
        sudo chmod -R 775 src/backend/laravel-crud-api/storage
        sudo chmod -R 775 src/backend/laravel-crud-api/bootstrap/cache

        # Cambiar el dueño de esas carpetas al usuario de Apache (dentro del contenedor es el ID 33)
        sudo chown -R 33:33 src/backend/laravel-crud-api/storage
        sudo chown -R 33:33 src/backend/laravel-crud-api/bootstrap/cache
    ``` 
* Instalar dependencias y generar clave (si es un proyecto nuevo)
    ```bash
        sudo docker exec -it php_app bash -c "composer update && composer install && php artisan key:generate"
    ``` 
* Migrar Base de datos
    ```
        sudo docker exec -it php_app php artisan migrate
    ```

## 1. Servicios

### 1.1 PHPMyAdmin

* Ruta: http://localhost:8081
* Usuario inicial: root
* Contraseña inicial: root

### 1.2 Laravel PHP App

* Ruta: http://localhost:8080

* En el caso de nobara hacen falta estos paquetes ademas de php
```
    sudo dnf install php-cli php-zip php-xml php-mbstring php-gd php-curl php-mysqlnd php-intl -y
```
* Crear proyecto con composer
```
    composer create-project laravel/laravel laravel-crud-api  

    php artisan install:api

    php artisan serve
```