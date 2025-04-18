<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];

    $stmt = $conn->prepare("INSERT INTO denuncias (descricao, categoria) VALUES (?, ?)");
    $stmt->bind_param("ss", $descricao, $categoria);

    if ($stmt->execute()) {
        echo "Denúncia enviada com sucesso.";
    } else {
        echo "Erro ao enviar denúncia: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>