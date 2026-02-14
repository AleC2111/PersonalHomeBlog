<?php 
require "schemas/users.schema.php";
require "middlewares/authentication.php";
require "services/formatResponse.php";
require "services/users.service.php";

function createUserController($db){
    $User = createUserSchema($db);
    
    $result = createUserQuery($db, $User);
    $responseJSON = ["status" => "success", "message" => "Usuario creado"];
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($responseJSON);

    pg_free_result($result);
}

function getUserController($db){
    $User = getUserSchema($db);

    $result = getUserQuery($db, $User);
    $responseJSON = getUserResponse($result);
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($responseJSON);

    pg_free_result($result);
}

function updateUserController($db){
    $User = updateUserShcema($db);
    authenticateUser($db, $User);
    
    $result = updateUserQuery($db, $User);
    $responseJSON = ["status" => "success", "message" => "Usuario actualizado"];
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($responseJSON);

    pg_free_result($result);
}

function deleteUserController($db){
    $User = deleteUserSchema($db);
    authenticateUser($db, $User);

    $result = deleteUserQuery($db, $User);
    $responseJSON = ["status" => "success", "message" => "Usuario eliminado"];
    header('Content-Type: application/json');
    http_response_code(200);
    echo json_encode($responseJSON);

    pg_free_result($result);
}
?>