<?php
include 'includes/config.php';

$id = $_POST['id'];
$sql = "UPDATE denuncias SET status='Resolvido' WHERE id=$id";
echo $conexao->query($sql) ? "OK" : "Erro ao resolver denúncia.";
?>