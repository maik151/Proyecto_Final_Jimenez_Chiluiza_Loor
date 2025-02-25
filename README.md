# Proyecto de Gestión de Libros y Autores

Este proyecto tiene como objetivo gestionar una base de datos de libros y autores. Permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) tanto para libros como para autores. Está desarrollado en PHP utilizando el patrón de arquitectura MVC (Modelo-Vista-Controlador).

## Estructura del Proyecto

El proyecto está organizado en diferentes carpetas, cada una con un propósito específico:

### 1. **Carpeta `app`**
   - **Controladores (`controllers`)**: Se encarga de manejar la lógica entre las vistas y los modelos.
     - `LibroController.php`: Controlador que gestiona las operaciones relacionadas con los libros.
     - `AutorController.php`: Controlador que gestiona las operaciones relacionadas con los autores.
   - **Modelos (`models`)**: Define la estructura de los datos y las operaciones sobre la base de datos.
     - `Libro.php`: Modelo que representa la entidad Libro en la base de datos.
     - `Autor.php`: Modelo que representa la entidad Autor en la base de datos.
   - **Repositorios (`repositories`)**: Encargados de la comunicación con la base de datos.
     - `LibroRepository.php`: Repositorio que maneja las consultas relacionadas con los libros.
     - `AutorRepository.php`: Repositorio que maneja las consultas relacionadas con los autores.
   - **Servicios (`services`)**: Lógica de negocio que interactúa con los repositorios.
     - `LibroService.php`: Servicio que maneja la lógica de negocio para los libros.
     - `AutorService.php`: Servicio que maneja la lógica de negocio para los autores.
   - **Core**: Archivos base del sistema, como las rutas y la configuración de acceso.
     - `Route.php`: Maneja el enrutamiento de las solicitudes a los controladores correspondientes.

### 2. **Carpeta `config`**
   - **`bd.sql`**: Script SQL que define la estructura inicial de la base de datos (tablas para libros y autores).
   - **`database.php`**: Configuración para la conexión a la base de datos utilizando PDO.
   - **`test_connection.php`**: Prueba para verificar la conexión a la base de datos.

### 3. **Carpeta `public`**
   - **`js`**: Archivos JavaScript para la funcionalidad dinámica del proyecto.
     - `app.js`: Contiene el código JavaScript para interactuar con el backend y manejar la lógica de frontend, como la creación y edición de libros y autores.
   - **`templates`**: Plantillas para las vistas del proyecto.
     - `footer.php`: Contiene el pie de página común para todas las vistas.
     - `header.php`: Contiene el encabezado común para todas las vistas.
     - `gestion.php`: Vista principal para gestionar los libros y autores, con un formulario para agregar/editar registros.

### 4. **Archivos raíz**
   - **`.htaccess`**: Archivo de configuración de Apache para reescribir las URLs y permitir URLs limpias.
   - **`index.php`**: El punto de entrada principal del proyecto. Carga la configuración y las rutas.

## Flujo del Proyecto

1. **Inicio de la aplicación**:
   - El archivo `index.php` carga las rutas definidas en `Route.php` y redirige a las vistas correspondientes.
   
2. **Rutas y Controladores**:
   - Las solicitudes entrantes son manejadas por las rutas definidas en `Route.php`. Cada ruta se asigna a un controlador específico.
   - `LibroController.php` y `AutorController.php` son responsables de manejar las solicitudes relacionadas con los libros y los autores respectivamente.
   
3. **Interacción con la Base de Datos**:
   - Los controladores se comunican con los servicios (`LibroService.php` y `AutorService.php`), que contienen la lógica de negocio para manejar las operaciones CRUD.
   - Los servicios utilizan los repositorios (`LibroRepository.php` y `AutorRepository.php`) para realizar las consultas a la base de datos.
   
4. **Modelo de Datos**:
   - Los modelos (`Libro.php` y `Autor.php`) representan las entidades correspondientes y son utilizados por los repositorios para interactuar con la base de datos.

5. **Vistas y Plantillas**:
   - Las vistas son responsables de presentar los datos al usuario. Utilizan las plantillas (`header.php`, `footer.php`, `gestion.php`) para estructurar el contenido HTML.
   - Los formularios de creación y edición de libros/autores permiten interactuar con la base de datos a través de los controladores y servicios.
   
## Configuración

### Base de Datos
1. Importa el archivo `bd.sql` en tu base de datos MySQL para crear las tablas necesarias.
2. Configura la conexión a la base de datos en `config/database.php` (usuario, contraseña y nombre de la base de datos).
3. Usa el archivo `test_connection.php` para verificar que la conexión con la base de datos sea exitosa.

### Archivo `.htaccess`
Este archivo permite que las rutas de tu proyecto sean más limpias y amigables para el usuario. Asegúrate de tener habilitado el módulo `mod_rewrite` en tu servidor Apache.

## Tecnologías Utilizadas

- **PHP**: Lenguaje de programación para el backend.
- **MySQL**: Base de datos relacional para almacenar los datos de los libros y autores.
- **Bootstrap**: Framework CSS para el diseño de la interfaz.
- **JavaScript (Axios)**: Para realizar solicitudes HTTP al backend y actualizar dinámicamente las vistas.
- **PDO (PHP Data Objects)**: Para interactuar de manera segura con la base de datos.
