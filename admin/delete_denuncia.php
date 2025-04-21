<?php
include 'includes/config.php';

$id = $_POST['id'];
$sql = "DELETE FROM denuncias WHERE id=$id";
echo $conexao->query($sql) ? "OK" : "Erro ao excluir denúncia.";
?>