<?php
session_start();
include('includes/config.php');

// Verifica se o usuário é admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit;
}

$id = (int) $_GET['id'];

// Buscar dados da denúncia com nomes completos das tabelas
$stmt = $conexao->prepare("
    SELECT 
        denuncias.*, 
        usuarios.nome AS usuario_nome, 
        categorias.nome AS categoria_nome
    FROM 
        denuncias
    JOIN 
        usuarios ON denuncias.usuario_id = usuarios.id
    JOIN 
        categorias ON denuncias.categoria_id = categorias.id
    WHERE 
        denuncias.id = :id
");
$stmt->execute([':id' => $id]);
$denuncia = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$denuncia) {
    echo "Denúncia não encontrada.";
    exit;
}

// Buscar provas relacionadas à denúncia
$stmt_provas = $conexao->prepare("SELECT * FROM provas WHERE denuncia_id = :id");
$stmt_provas->execute([':id' => $id]);
$provas = $stmt_provas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ver Denúncia</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="dashboard.php">Início</a></li>
            <li><a href="categorias.php">Categorias</a></li>
            <li><a href="usuarios.php">Usuários</a></li>
            <li><a href="mensagens.php">Mensagens de Contato</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Detalhes da Denúncia</h1>
        <p><strong>Título:</strong> <?= htmlspecialchars($denuncia['titulo']) ?></p>
        <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($denuncia['descricao'])) ?></p>
        <p><strong>Categoria:</strong> <?= htmlspecialchars($denuncia['categoria_nome']) ?></p>
        <p><strong>Usuário:</strong> <?= htmlspecialchars($denuncia['usuario_nome']) ?></p>
        <p><strong>Status:</strong> <?= ucfirst($denuncia['status']) ?></p>
        <p><strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($denuncia['data_criacao'])) ?></p>

        <h2>Provas Anexadas</h2>
        <?php if (count($provas) > 0): ?>
            <ul>
                <?php foreach ($provas as $prova): ?>
                    <li>
                        <a href="<?= htmlspecialchars($prova['caminho_arquivo']) ?>" target="_blank">Ver Arquivo</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nenhuma prova foi anexada.</p>
        <?php endif; ?>

        <p><a href="dashboard.php">← Voltar para o painel</a></p>
    </div>
</body>
</html>
