<?php 
function getUserResponse($result){
    $data = [];
    $numberRows = 0; // Implementar paginación
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
?>