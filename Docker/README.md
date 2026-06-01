# Guía de Entorno: S+ Fitness (Docker & Laravel)

Esta documentación detalla los pasos necesarios para instalar, configurar y arrancar el entorno de desarrollo local del proyecto. Además, incluye un compendio organizado de los comandos más útiles y recurrentes para el trabajo diario utilizando Docker y Laravel Artisan.

---

## 1. Preparación e Instalación del Entorno

Antes de inicializar la infraestructura del proyecto, es necesario preparar el sistema operativo anfitrión.

**Instalar Docker y Docker Compose:**
```bash
    sudo dnf install docker docker-compose
```

**Arrancar y habilitar el demonio de Docker (para que inicie con el sistema):**
```bash
    sudo systemctl enable --now docker
```

**Dependencias adicionales (Específico para Nobara / Fedora):**
En el caso de utilizar distribuciones como Nobara, hacen falta estos paquetes además de `php` para garantizar que el entorno local pueda procesar las dependencias correctamente sin errores de extensiones:
```bash
    sudo dnf install php-cli php-zip php-xml php-mbstring php-gd php-curl php-mysqlnd php-intl -y
```

---

## 2. Levantando la Infraestructura con Docker

La aplicación está completamente contenedorizada, lo que facilita enormemente su arranque.

**Arrancar Servicios docker-compose Docker (Uso diario):**
```bash
    sudo docker compose up -d
```

**Reconstruye y levanta (Imprescindible si has modificado variables de entorno o archivos Dockerfile):**
```bash
    sudo docker compose up -d --build
```

### 2.1. Servicios Disponibles en los Contenedores
Una vez levantados los contenedores, tendrás a tu disposición:
* **Laravel PHP App:** Accesible en [http://localhost:8080](http://localhost:8080)
* **PHPMyAdmin:** Accesible en [http://localhost:8081](http://localhost:8081)
  * **Usuario inicial:** root
  * **Contraseña inicial:** root

---

## 3. Configuración Inicial del Proyecto Laravel

Si es la primera vez que clonas el repositorio o levantas el entorno, debes configurar los permisos de almacenamiento y descargar las librerías.

**Permisos Laravel (Ruta basada en el directorio del `docker-compose.yml`):**
Esto soluciona los clásicos problemas de "Permission Denied" al escribir logs o almacenar imágenes.
```bash
    # Dar permisos de escritura a las carpetas que Laravel necesita
    sudo chmod -R 775 src/backend/laravel-crud-api/storage
    sudo chmod -R 775 src/backend/laravel-crud-api/bootstrap/cache

    # Cambiar el dueño de esas carpetas al usuario de Apache (dentro del contenedor es el ID 33)
    sudo chown -R 33:33 src/backend/laravel-crud-api/storage
    sudo chown -R 33:33 src/backend/laravel-crud-api/bootstrap/cache
```

**Instalar dependencias y generar clave (Si es un proyecto nuevo):**
Este comando compuesto es fundamental para que Laravel funcione, actualizando los paquetes y seteando la variable `APP_KEY` de tu `.env`.
```bash
    sudo docker exec -it php_app bash -c "composer update && composer install && php artisan key:generate"
```

**Configuración de Storage:**
Imprescindible para que los recursos estáticos subidos por los usuarios (como imágenes de perfil) sean públicamente accesibles.
```bash
    sudo docker exec -it php_app php artisan storage:link
```
*(Crea enlace simbólico storage, el comando equivalente)*
```bash
    sudo docker exec -it php_app php artisan storage:link
```

---

## 4. Ejecución del Servidor Web (Modo de Desarrollo)

Aunque Docker ya sirve la web a través de Apache, en ocasiones puede ser útil arrancar el servidor interno de Artisan para ver logs directos o debugear.

**Ejecutar Apache (Dentro del contenedor Docker):**
```bash
    sudo docker exec -it php_app php artisan serve
```

**Ejecutar de forma local:**
```bash
    php artisan serve --port=8080
```

---

## 5. Gestión de la Base de Datos y Migraciones

Estos comandos te permiten aplicar la estructura (esquemas) a la base de datos vacía, o resetearla si necesitas limpiar el entorno de desarrollo.

**Migrar Base de datos (Aplica los últimos cambios que hayas programado):**
```bash
    sudo docker exec -it php_app php artisan migrate
```

**Migrar Base de datos reemplazo (¡Atención! Borra todas las tablas y las crea de nuevo):**
```bash
    sudo docker exec -it php_app php artisan migrate:fresh
```

**Crear migración Sanctum (Para el sistema de tokens de autenticación):**
```bash
    artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

---

## 6. Generación Rápida de Código (Comandos de Artisan)

Laravel ofrece herramientas potentes para automatizar la creación del esqueleto de los archivos. Esto ahorra mucho tiempo y asegura que las clases sigan los estándares del framework.

**Crear un controlador:**
```bash
    php artisan make:controller EjercicioController
```

**Crear un modelo con su migración al mismo tiempo (gracias a la bandera `-m`):**
```bash
    php artisan make:model Ejercicio -m
```

**Crear un service (Capa lógica adicional, si estás usando un patrón Service-Repository):**
```bash
    php artisan make:service ArchivoService
```

**Crea Request para validación (ejecutado dentro del contenedor):**
Ideal para validar los datos que llegan por un método POST, por ejemplo al crear un usuario.
```bash
    sudo docker exec -it php_app php artisan make:request StoreUserRequest
```

**Crear Form Request (para validaciones, ejecutado en local):**
```bash
    php artisan make:request UpdateUserRequest
```

**Verificar que todas las rutas:**
Permite ver en una tabla toda la API disponible y qué función del controlador atiende a cada endpoint.
```bash
    php artisan route:list
```

---

## 7. Histórico: Comandos de Creación de Proyecto

Si alguna vez necesitas iniciar un proyecto API similar desde cero absoluto usando Composer, el flujo sería este:

**Crear proyecto con composer:**
```bash
    composer create-project laravel/laravel laravel-crud-api  

    php artisan install:api

    <!--Ejecutar para instalar dependencias proyecto-->

    composer install

    php artisan serve --port=8080
```