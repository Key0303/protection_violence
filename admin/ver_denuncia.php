<?php
session_start();
include('includes/config.php');

// Verifica se o usuário é admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'admin') {
    header("Location: ../login.php");
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
    <link rel="stylesheet" href="css/style.css">
  
</head>
<body>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>

    <div class="main-content">
        <h1>Detalhes da Denúncia</h1>

        <!-- Tabela para exibir os detalhes da denúncia -->
        <table class="table-container">
            <tr>
                <th>Título</th>
                <td><?= htmlspecialchars($denuncia['titulo']) ?></td>
            </tr>
            <tr>
                <th>Descrição</th>
                <td class="description"><?= nl2br(htmlspecialchars($denuncia['descricao'])) ?></td>
            </tr>
            <tr>
                <th>Categoria</th>
                <td><?= htmlspecialchars($denuncia['categoria_nome']) ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?= ucfirst($denuncia['status']) ?></td>
            </tr>
            <tr>
                <th>Data de Criação</th>
                <td><?= date('d/m/Y H:i', strtotime($denuncia['data_criacao'])) ?></td>
            </tr>
            <tr>
                <th>Nome do Usuário</th>
                <td><?= htmlspecialchars($denuncia['usuario_nome']) ?></td>
            </tr>
        </table>

        <!-- Tabela para exibir provas anexadas -->
        <h2>Provas Anexadas</h2>
        <?php if (count($provas) > 0): ?>
            <table class="table-container">
                <thead>
                    <tr>
                        <th>Nome do Arquivo</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($provas as $prova): ?>
                        <tr>
                            <td><?= htmlspecialchars($prova['nome_arquivo']) ?></td>
                            <td><a href="<?= htmlspecialchars($prova['caminho_arquivo']) ?>" target="_blank">Ver Arquivo</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhuma prova foi anexada.</p>
        <?php endif; ?>
    </div>
</body>
</html>
