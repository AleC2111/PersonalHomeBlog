<?php 
// Implementar paginación
function getUserResponse($result){
    $data = [];
    $numberRows = 0; 
    while ($row = pg_fetch_assoc($result)) {
        $numberRows += count($row)/3;
        $data[] = [
            "id" => $row["id_usuario"],
            "name" => $row["name"],
            "email" => $row["email"]
        ];
    }
    $response = [
        "status" => "success",
        "message" => "Datos recibidos correctamente",
        "data" => $data
    ];

    return $response;
}

function getPostResponse($result){
    $data = [];
    $numberRows = 0; 
    while ($row = pg_fetch_assoc($result)) {
        $numberRows += count($row)/8;
        $data[] = [
            "id" => $row["id_post"],
            "title" => $row["title"],
            "content" => $row["content"],
            "category" => $row["category"],
            "tags" => $row["tags"],
            "creation_date" => $row["creation_date"],
            "update_date" => $row["update_date"],
            "id_usuario" => $row["id_usuario"]
        ];
    }
    $response = [
        "status" => "success",
        "message" => "Datos recibidos correctamente",
        "data" => $data
    ];

    return $response;
}
?>