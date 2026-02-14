<?php 
function createUsersTable($db){
    $query = "CREATE TABLE IF NOT EXISTS usuario (
        id_usuario SERIAL PRIMARY KEY,
        name VARCHAR(30) UNIQUE NOT NULL,
        email VARCHAR(30),
        password VARCHAR(100) NOT NULL, 
        salt VARCHAR(50) NOT NULL
    );";
    $result = pg_query($db, $query);

    if ($result) {
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Tabla 'usuario' creada exitosamente o ya existía.\n", FILE_APPEND);
    } else {
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error: No se pudo crear la tabla 'usuario'".pg_last_error($db), FILE_APPEND);
        exit;
    }
}
?>