<?php 
function createCommentsTable($db){
    $query = "CREATE TABLE IF NOT EXISTS comment (
        id_comment SERIAL PRIMARY KEY, 
        content VARCHAR(200) NOT NULL, 
        id_post INTEGER, 
        id_usuario INTEGER, 
        CONSTRAINT fk_post 
            FOREIGN KEY(id_post) 
            REFERENCES post(id_post) 
            ON DELETE CASCADE, 
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