<?php
session_start();
include('includes/config.php');

// Verifica se o usuário é admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: categoria.php");
    exit;
}

$id = (int) $_GET['id'];

// Excluir a categoria
$stmt = $conexao->prepare("DELETE FROM categorias WHERE id = :id");
$stmt->execute([':id' => $id]);

header("Location: categoria.php");
exit;
?>
