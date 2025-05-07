<?php
session_start();
include('includes/config.php');

// Verifica se é um administrador logado
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Verifica se o ID foi passado
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET['id'];

// Atualiza o status da denúncia para "resolvida"
$stmt = $conexao->prepare("UPDATE denuncias SET status = 'resolvida' WHERE id = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);

if ($stmt->execute()) {
    // Redireciona de volta ao dashboard com sucesso
    header("Location: dashboard.php?resolvido=1");
} else {
    echo "Erro ao resolver a denúncia.";
}
?>
