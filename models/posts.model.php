<?php 
function createPostsTable($db){
    $query = "CREATE TABLE IF NOT EXISTS post (
        id_post SERIAL PRIMARY KEY, 
        title VARCHAR(30) NOT NULL, 
        content VARCHAR(200) NOT NULL, 
        category VARCHAR(30), 
        tags TEXT[], 
        creation_date TIMESTAMPTZ NOT NULL, 
        updating_date TIMESTAMPTZ, 
        id_usuario INTEGER, 
        CONSTRAINT fk_usuario 
            FOREIGN KEY(id_usuario) 
            REFERENCES usuario(id_usuario) 
            ON DELETE CASCADE
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