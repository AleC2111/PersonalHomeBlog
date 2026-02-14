<?php
require "objects/UserData.php";

function createUserSchema($db){
    $json_data = file_get_contents('php://input');
    $user_data = json_decode($json_data);
    $User = new UserData();
    try {
        $User->setName($user_data->name, $db);
        $User->setEmail($user_data->email);
        $User->setPassword($user_data->email, $db);
        $User->isUserUnique($db);
        $User->hashPassword();
    } catch(Exception $error){
        $data = ["status" => "error", "message" => $error];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($data);
        exit;
    }

    return $User;
}

function getUserSchema($db){
    $User = new UserData();
    try {
        $User->setName($_GET['name'] ?? 'All', $db);
    } catch(Exception $error){
        $data = ["status" => "error", "message" => $error];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($data);
        exit;
    }

    return $User;
}

function updateUserShcema($db){
    $json_data = file_get_contents('php://input');
    $user_data = json_decode($json_data);
    $User = new UserData();
    try {
        $User->setName($user_data->name, $db);
        $User->setEmail($user_data->email);
        $User->setPassword($user_data->email, $db);
    } catch(Exception $error){
        $data = ["status" => "error", "message" => $error];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($data);
        exit;
    }

    return $User;
}

function deleteUserSchema($db){
    $json_data = file_get_contents('php://input');
    $user_data = json_decode($json_data);
    $User = new UserData();
    try {
        $User->setName($user_data->name, $db);
        $User->setPassword($user_data->email, $db);
    } catch(Exception $error){
        $data = ["status" => "error", "message" => $error];
        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode($data);
        exit;
    }

    return $User;
}
?>