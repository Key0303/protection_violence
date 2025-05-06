<?php
include('includes/config.php');

$denuncia = null;
$msg = "";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conexao->prepare("
        SELECT d.id, d.titulo, d.descricao, d.status, d.criada_em, d.anonima,
               c.nome AS categoria
        FROM denuncias d
        JOIN categorias c ON d.categoria_id = c.id
        WHERE d.id = ?
    ");
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
    <meta charset="UTF-8" />
    <title>Home - Site de Denúncias</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/styles_img.css" />
    <link rel="stylesheet" href="assets/package/swiper-bundle.min.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
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
            <li><strong>Título:</strong> <?php echo htmlspecialchars($denuncia['titulo']); ?></li>
            <li><strong>Categoria:</strong> <?php echo $denuncia['categoria']; ?></li>
            <li><strong>Status:</strong> <?php echo ucfirst($denuncia['status']); ?></li>
            <li><strong>Data de Criação:</strong> <?php echo date("d/m/Y H:i", strtotime($denuncia['criada_em'])); ?></li>
            <li><strong>Denúncia Anônima?:</strong> <?php echo $denuncia['anonima'] ? 'Sim' : 'Não'; ?></li>
            <li><strong>Descrição:</strong> <?php echo nl2br(htmlspecialchars($denuncia['descricao'])); ?></li>
        </ul>
    <?php endif; ?>
</div>

<?php include('includes/footer.php'); ?>

</body>
</html>
