<?php
include 'includes/config.php';

$nome = $_POST['nome'];
$assunto = $_POST['assunto'];
$status = $_POST['status'] ?? 'Pendente';

$stmt = $conexao->prepare("INSERT INTO denuncias (nome, assunto, status) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nome, $assunto, $status);

echo $stmt->execute() ? "OK" : "Erro ao adicionar denúncia.";
?>