<?php
require("_global.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $rank_scale = $_POST["rank_scale"];
    $rank_product = $_POST["rank_product"];

    $sql1 = <<<SQL
        INSERT INTO ranking (rank_scale, rank_product) VALUES (?,?)
    SQL;

    
    if ($conn->query($sql) === TRUE) {
        echo "Avaliação enviada com sucesso!";
    } else {
        echo "Erro ao enviar avaliação: " . $conn->error;
    }

    
    $conn->close();
}
?>