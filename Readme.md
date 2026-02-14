# Blog
Este es un proyecto que se hizo con el proposito para aprender PHP y PostgreSQL
## Correr el proyecto
- Para correr el programa se debe tener Linux e instalar PostgreSQL
- Decargar en la terminal los paquetes `sudo apt install composer && sudo apt install php-pgsql`
- Dentro de la carpeta del proyecto escribir en la terminal `composer require vlucas/phpdotenv`
- Escribe las credenciales de la base de datos en un .env 
- Corre el proyecto con `php -S localhost:8000`

## Falta por implementar
- posts.php 
    - Crear posts asociados a un usuario
    - Ver un post con su información
    - Filtrar posts por usuarios, categoría o tags
    - Actualizar un post
    - Eliminar un post
- comments.php
    - Ver comentarios asociados a un usuario
    - Hacer el CRUD con comentarios asociados a un usuario y un post
- Crear las Vistas
- Paginación cuando se quiere ver todos los elementos de alguna ruta GET
- Implementar Rate Limiting
- Crear API KEYS
