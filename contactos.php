<?php
include('includes/config.php');

$msg = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nomecompleto']);
    $email = trim($_POST['email']);
    $mensagem = trim($_POST['mensagem']);

    if (!empty($nome) && !empty($email) && !empty($mensagem)) {
        $stmt = $pdo->prepare("INSERT INTO mensagens_contato (nome, email, mensagem) VALUES (?, ?, ?)");
        if ($stmt->execute([$nome, $email, $mensagem])) {
            $msg = "Mensagem enviada com sucesso!";
        } else {
            $msg = "Erro ao enviar a mensagem.";
        }
    } else {
        $msg = "Por favor, preencha todos os campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos - Site de Denúncias</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/styles_img.css" />
    <link rel="stylesheet" href="assets/package/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
</head>
<body>
<?php include('includes/header.php');?>

<section class="contactos container my-5">
    <h2 class="mb-4">Entre em contato conosco</h2>
    
    <?php if ($msg): ?>
        <div class="alert alert-info"><?php echo $msg; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <input type="text" class="form-control" name="nomecompleto" placeholder="Nome completo" required />
        </div>
        <div class="mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email" required />
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="mensagem" rows="5" placeholder="Digite sua mensagem..." required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</section>

<?php include('includes/footer.php'); ?>
</body>
</html>
