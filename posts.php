<?php 
require "dbConnection.php";
require "controllers/posts.controllers.php";
require "utils/errorHandler.php";

set_error_handler("exceptions_error_handler");
$db = dbConnect();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    createPostController($db);
}
if($_SERVER["REQUEST_METHOD"]=="GET"){
    getPostController($db);
}
if($_SERVER["REQUEST_METHOD"]=="PATCH"){
    updatePostController($db);
}
if($_SERVER["REQUEST_METHOD"]=="DELETE"){
    deletePostController($db);
}

pg_close($db);
?>