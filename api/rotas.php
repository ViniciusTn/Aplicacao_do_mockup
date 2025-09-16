<?php

function getRotasPorTrem($id_trem) {
    global $conn; 

    $stmt = $conn->prepare("SELECT * FROM rotas WHERE id_trem = ?");
    $stmt->bind_param("i", $id_trem);
    $stmt->execute();
    $result = $stmt->get_result();

    $rotas = [];
    while ($row = $result->fetch_assoc()) {
        $rotas[] = $row;
    }

    $stmt->close();
    return $rotas;
}

?>
