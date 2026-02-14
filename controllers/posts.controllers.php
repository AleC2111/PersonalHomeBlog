<?php 
require "schemas/posts.schema.php";
require "services/posts.service.php";

function createPostController($db){
    $Post = createPostSchema($db);

    $result = createPostQuery($db, $Post);
    $responseJSON = ["status" => "success", "message" => "Post creado"];
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($responseJSON);

    pg_free_result($result);
}

function getPostController($db){
    $Post = getPostSchema();

    $result = getPostQuery($db, $Post);
    $responseJSON = getPostResponse($result);
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($responseJSON);

    pg_free_result($result);
}

function updatePostController($db){
    
}

function deletePostController($db){
    
}
?>