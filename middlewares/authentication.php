<?php
require "objects/UserData.php";

function getServerSalt($db, $filteredName){
    try {
        $query = "SELECT salt FROM usuario WHERE name='$filteredName';";
        $result = pg_query($db, $query);
        if (!$result) {
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error encontrando sal: " . pg_last_error()."\n", FILE_APPEND);
            exit;
        }
        $salt = pg_fetch_result($result, 0);
    } catch(Exception $error){
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error encontrado: ".$error."\n", FILE_APPEND);
        exit;
    }
    return $salt;
}

function isPasswordCorrect($db, $hashedPassword){
    try {
        $query = "SELECT EXISTS(SELECT password FROM usuario WHERE password='$hashedPassword');";
        $result = pg_query($db, $query);
        $checkExistsUser = pg_fetch_result($result, 0);
        if (!$result) {
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error en la contraseña: ".pg_last_error()."\n", FILE_APPEND);
            exit;
        }
        elseif($result || $checkExistsUser=="f"){
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error contraseña incorrecta", FILE_APPEND);
            $data = ["status" => "error", "message" => "Error contraseña incorrecta"];
            header('Content-Type: application/json');
            http_response_code(429);
            echo json_encode($data);
            return false;
        }
    } catch(Exception $error){
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error en la contraseña: ".$error."\n", FILE_APPEND);
        exit;
    }
    return true;
}

function authenticateUser($db, $User){
    $serverSavedSalt = getServerSalt($db, $User->getName());
    $User->setSalt($serverSavedSalt);
    $User->hashPassword();
    if(!isPasswordCorrect($db, $User->getPassword())){
        exit;
    }
}
?>