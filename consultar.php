<?php
include('includes/config.php');

$denuncia = null;
$msg = "";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $pdo->prepare("SELECT d.id, d.descricao, d.status, d.data_envio, c.nome AS categoria
                           FROM denuncias d
                           JOIN categoria c ON d.categoria_id = c.id
                           WHERE d.id = ?");
    $stmt->execute([$id]);
    $denuncia = $stmt->fetch();
    
    if (!$denuncia) {
        $msg = "Denúncia não encontrada.";
    }
} else {
    $msg = "ID de denúncia inválido.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Denúncia</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include('includes/header.php'); ?>

<div class="container my-5">
    <h2>Detalhes da Denúncia</h2>

    <?php if ($msg): ?>
        <div class="alert alert-danger"><?php echo $msg; ?></div>
    <?php elseif ($denuncia): ?>
        <ul>
            <li><strong>ID:</strong> <?php echo $denuncia['id']; ?></li>
            <li><strong>Categoria:</strong> <?php echo $denuncia['categoria']; ?></li>
            <li><strong>Status:</strong> <?php echo $denuncia['status']; ?></li>
            <li><strong>Data:</strong> <?php echo date("d/m/Y H:i", strtotime($denuncia['data_envio'])); ?></li>
            <li><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($denuncia['descricao'])); ?></li>
        </ul>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
