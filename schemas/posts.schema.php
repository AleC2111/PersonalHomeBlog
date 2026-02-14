<?php 
require "objects/PostData.php";

function createPostSchema($db){
    $json_data = file_get_contents('php://input');
    $user_data = json_decode($json_data);
    $Post = new PostData();
    try {
        $Post->setTitle($user_data->title, $db);
        $Post->setContent($user_data->content, $db);
        $Post->setCategory($user_data->category ?? "Ninguno", $db);
        $Post->setTags($user_data->tags ?? ["Ninguno"], $db);
        $Post->setUserId($user_data->userId);
    } catch(Exception $error){
        $data = ["status" => "error", "message" => $error];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($data);
        exit;
    }

    return $Post;
}

function getPostSchema(){
    $Post = new PostData();
    try {
        if($_GET['id']) $Post->setPostId($_GET['id']);
        if($_GET['user']) $Post->setUserId($_GET['user']);
    } catch(Exception $error){
        $data = ["status" => "error", "message" => $error];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($data);
        exit;
    }

    return $Post;
}

?>