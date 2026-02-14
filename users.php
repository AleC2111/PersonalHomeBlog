<?php
require "dbConnection.php";
require "controllers/users.controllers.php";
require "utils/errorHandler.php";

set_error_handler("exceptions_error_handler");
$db = dbConnect();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    createUserController($db);
}
if($_SERVER["REQUEST_METHOD"]=="GET"){
    getUserController($db);
}
if($_SERVER["REQUEST_METHOD"]=="PATCH"){
    updateUserController($db);
}
if($_SERVER["REQUEST_METHOD"]=="DELETE"){
    deleteUserController($db);
}

pg_close($db);
?>