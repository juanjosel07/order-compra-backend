# 📦 Backend - Módulo Orden de Compras (Laravel)

Este proyecto es el backend para la aplicación de **Módulo Orden de Compras** utilizando el framework **Laravel**, especificamente **Laravel10**. Proporciona una Api para la gestión de ordenes de compra, crear, editar, eliminar y obtener las ordenes, usando Datatable para mejorar el rendimiento al obtener las ordenes y no enviarlas todas sino en cada paginación.

# Dependencias Principales

-   **Testing**: PHPUnit
-   **Datatables**: Yajra Laravel Datatables
-   **PHPUnit**: ^10.1 (Para pruebas unitarias)

## 🔧 Requisitos

Para ejecutar este proyecto, necesitas tener lo siguiente instalado:

-   Wampserver o xampp (entornos)
-   Composer 2.0+ (para manejar las dependencias)
-   PHP >= 8.1
-   MySQL 5.0 o superior

## 🚀 Instalación

1. **Clona el repositorio**:

    ```bash
    git clone git@github.com:juanjosel07/order-compra-backend.git
    ```

2. **Instalar dependencias**:

    ```bash
    composer install
    ```

3. **Variables de entorno**

-   las variables de entorno mas importantes son :

    ```bash
    	DB_CONNECTION=mysql
    	DB_HOST=127.0.0.1
    	DB_PORT= Usar el puerto de tu servidor MySQL (XAMPP/WAMP/Laragon)
    	DB_DATABASE	= nombre base de datos
    	DB_USERNAME=root
    	DB_PASSWORD= dejar vacío

    	FRONTEND_URL = http://localhost:5173 -> pones el puerto local de tu frontend

    ```

-   crea un archivo .env y copia del archivo .env.example y reemplaza por las variables tuyas.

    ```bash
      cp .env.example .env
      php artisan key:generate
    ```

3. **Correr migraciones con los seeders y factories**

    ```bash
    php artisan migrate --seed
    ```

4. **Inicia el servidor de desarrollo**

    ```bash
    php artisan server
    ```

markdown
Copiar
Editar

## 📡 Rutas de la API

### Rutas de Ordenes (`/api/orders`)

-   **Obtener todas las órdenes**  
    `GET /api/orders`  
    Devuelve con Datatable las ordenes existentes.

-   **Obtener una orden específica**  
    `GET /api/orders/{order}`  
    Devuelve la orden con el id dado y sus respectivo detalles.

-   **Crear una nueva orden**  
    `POST /api/orders`  
    Crea una orden de compra nueva.

-   **Actualizar una orden existente**  
    `PUT /api/orders/{order}`  
    Actualiza los datos de una orden de compra existente.

-   **Eliminar una orden**  
    `DELETE /api/orders/{order}`  
    Elimina orden de compra por id

    ### Rutas de Productos (`/api/products`)

-   **Obtener todos los productos**  
    `GET /api/products`  
    Devuelve los productos existentes en base de datos, todos.

# 🌐 Demo Online

Próximamente...

# Autor

-   Juan Jose Leon

## 📄 Licencia

Este proyecto **no tiene licencia definida**. Puedes Clonarlo y estudiarlo.
