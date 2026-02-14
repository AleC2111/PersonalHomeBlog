<?php 
require "objects/PostData.php";

function createPostQuery($db, $Post){
    $title = $Post->getTitle();
    $content = $Post->getContent();
    $category = $Post->getCategory();
    $tags = $Post->getTags();
    $date = $Post->getDate();
    $userId = $Post->getUserId();
    try{
        $query = "INSERT INTO post (title, content, category, tags, creation_date, id_usuario)
            VALUES ('$title', '$content', '$category', '$tags', '$date', '$userId');";
        $result = pg_query($db, $query);
        if (!$result) {
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error en la inserción: " . pg_last_error()."\n", FILE_APPEND);
            exit;
        }
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Post creado para el usuario con id: \n", FILE_APPEND);
    } catch(Exception $error){
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error encontrado: ".$error."\n", FILE_APPEND);
        exit;
    }
    unset($Post);
    return $result;
}

function getPostQuery($db, $Post){
    $postId = $Post->getPostId();
    $userId = $Post->getUserId();
    try {
        $query = "SELECT id_post, title, content, category, 
        tags, creation_date, update_date, id_usuario FROM post";
        $query .= $postId==0 ? ";": " WHERE id_post='$postId';";
        $result = pg_query($db, $query);
        if (!$result) {
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error en la consulta: " . pg_last_error()."\n", FILE_APPEND);
            exit;
        }
        $logText = "Posts obtenidos según su Id";
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] ".$logText."\n", FILE_APPEND);
    } catch(Exception $error){
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error encontrado: ".$error."\n", FILE_APPEND);
    }
    unset($Post);
    return $result;
}
?>