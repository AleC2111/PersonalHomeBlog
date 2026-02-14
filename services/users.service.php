<?php 
require "objects/UserData.php";

function createUserQuery($db, $User){
    $filteredName = $User->getName(); 
    $filteredEmail = $User->getEmail();
    $hashedPassword = $User->getPassword(); 
    $salt = $User->getSalt();
    try{
        $query = "INSERT INTO usuario (name, email, password, salt)
            VALUES ('$filteredName', '$filteredEmail', '$hashedPassword', '$salt');";
        $result = pg_query($db, $query);
        if (!$result) {
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error en la inserción: " . pg_last_error()."\n", FILE_APPEND);
            exit;
        }
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Usuario creado: $filteredName\n", FILE_APPEND);
    } catch(Exception $error){
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error encontrado: ".$error."\n", FILE_APPEND);
        exit;
    }
    unset($User);
    return $result;
}

function getUserQuery($db, $User){
    $filteredName = $User->getName();
    try {
        $query = "SELECT id_usuario, name, email FROM usuario";
        $query .= $filteredName=='All' ? ";": " WHERE name='$filteredName';";
        $result = pg_query($db, $query);
        if (!$result) {
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error en la consulta: " . pg_last_error()."\n", FILE_APPEND);
            exit;
        }
        $logText = $filteredName=='All' ? "Obtener informacion de todos los usuario hasta: ":"Usuario obtenido: $filteredName";
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] ".$logText."\n", FILE_APPEND);
    } catch(Exception $error){
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error encontrado: ".$error."\n", FILE_APPEND);
    }
    unset($User);
    return $result;
}

function updateUserQuery($db, $User){
    $filteredName = $User->getName(); 
    $filteredEmail = $User->getEmail();
    try {
        $query = "UPDATE usuario SET email='$filteredEmail' WHERE name='$filteredName';";
        $result = pg_query($db, $query);
        if (!$result) {
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error en la actualización: " . pg_last_error()."\n", FILE_APPEND);
            exit;
        }
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Usuario actualizado: $filteredName\n", FILE_APPEND);
    } catch(Exception $error){
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error encontrado: ".$error."\n", FILE_APPEND);
    }
    unset($User);
    return $result;
}

function deleteUserQuery($db, $User){
    $filteredName = $User->getName(); 
    try {
        $query = "DELETE FROM usuario WHERE name='$filteredName' RETURNING *;";
        $result = pg_query($db, $query);
        if (!$result) {
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error en la eliminación: " . pg_last_error()."\n", FILE_APPEND);
            exit;
        }
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Usuario eliminado: $filteredName\n", FILE_APPEND);
    } catch(Exception $error){
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error encontrado: ".$error."\n", FILE_APPEND);
    }
    unset($User);
    return $result;
}
?>