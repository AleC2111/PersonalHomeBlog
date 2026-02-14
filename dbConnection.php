<?php 
require "models/users.model.php";
require "models/posts.model.php";
require "models/comments.model.php";

function dbConnect(){
    require_once 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load(); 
    $host = $_ENV['DB_HOST'];
    $port = $_ENV['PORT'];
    $dbName = $_ENV['DB_NAME'] ?? "postgres";
    $user = $_ENV['USER'];
    $password = $_ENV['PASSWORD'];

    $connection_string = "host=$host port=$port dbname=$dbName user=$user password=$password";
    $db = pg_connect($connection_string);
    if (!$db) {
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error: No se pudo conectar a la base de datos.\n", FILE_APPEND);
        exit;
    }
    $connection_string = "host=$host port=$port user=$user password=$password dbname=";
    createStartDatabase($db, $dbName, $connection_string);
    createUsersTable($db);
    createPostsTable($db);
    createCommentsTable($db);
    file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Conexión exitosa a PostgreSQL.\n", FILE_APPEND);
    return $db;
}

function createStartDatabase($db, $dbName, $connection_string){
    if($dbName!="blog_db"){
        file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] No existe base de datos proceder a crearla.\n", FILE_APPEND);
        $query = "CREATE DATABASE blog_db IF NOT EXISTS;";
        $result = pg_query($db, $query);
        if ($result) {
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error: Base de datos creada existosamente.\n", FILE_APPEND);
            $dbName = "blog_db";
            pg_close($db);
            $connection_string = $connection_string.$dbName;
            $db = pg_connect($connection_string);
        }
        else{
            file_put_contents('debug.log', "[".date('Y/m/d H:i:s')."] Error: No se pudo crear la base de datos".pg_last_error($db), FILE_APPEND);
            exit;
        }
    }
}
?>