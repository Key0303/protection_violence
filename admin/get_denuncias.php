<?php
include 'includes/config.php';

$sql = "SELECT * FROM denuncias ORDER BY id DESC";
$result = $conexao->query($sql);

$dados = [];
while ($row = $result->fetch_assoc()) {
    $dados[] = $row;
}
echo json_encode($dados);
?>