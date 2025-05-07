<?php
session_start();
include('includes/config.php');

// Verifica se o usuário está logado e é administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Buscar todas as denúncias com JOIN
$stmt_denuncias = $conexao->prepare("
    SELECT denuncias.id, denuncias.titulo, denuncias.status, usuarios.nome AS usuario_nome, categorias.nome AS categoria_nome
    FROM denuncias
    JOIN usuarios ON denuncias.usuario_id = usuarios.id
    JOIN categorias ON denuncias.categoria_id = categorias.id
    ORDER BY denuncias.id DESC
");
$stmt_denuncias->execute();
$denuncias = $stmt_denuncias->fetchAll(PDO::FETCH_ASSOC);

// Buscar todas as categorias
$stmt_categorias = $conexao->prepare("SELECT * FROM categorias ORDER BY nome ASC");
$stmt_categorias->execute();
$categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

// Buscar todas as provas
$stmt_provas = $conexao->prepare("
    SELECT provas.id, provas.caminho_arquivo, denuncias.titulo AS denuncia_titulo
    FROM provas
    JOIN denuncias ON provas.denuncia_id = denuncias.id
    ORDER BY provas.id DESC
");
$stmt_provas->execute();
$provas = $stmt_provas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - Sistema de Denúncias</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
</head>
<body>

<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>

<!-- Conteúdo principal -->
<div class="main-content">

    <!-- Denúncias -->
    <h2>Denúncias</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Usuário</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($denuncias as $denuncia): ?>
                    <tr>
                        <td><?= htmlspecialchars($denuncia['titulo']) ?></td>
                        <td><?= htmlspecialchars($denuncia['categoria_nome']) ?></td>
                        <td><?= htmlspecialchars($denuncia['usuario_nome']) ?></td>
                        <td class="<?= $denuncia['status'] === 'resolvida' ? 'status-resolvida' : 'status-pendente' ?>">
                            <?= ucfirst(htmlspecialchars($denuncia['status'])) ?>
                        </td>
                        <td>
                            <a href="ver_denuncia.php?id=<?= $denuncia['id'] ?>" class="button">Ver</a> |
                            <?php if ($denuncia['status'] !== 'resolvida'): ?>
                                <a href="resolver_denuncia.php?id=<?= $denuncia['id'] ?>" class="button">Resolver</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Categorias -->
    <h2>Categorias de Denúncias</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                    <tr>
                        <td><?= htmlspecialchars($categoria['nome']) ?></td>
                        <td>
                            <a href="editar_categoria.php?id=<?= $categoria['id'] ?>" class="button">Editar</a> |
                            <a href="deletar_categoria.php?id=<?= $categoria['id'] ?>" onclick="return confirm('Deseja excluir esta categoria?')" class="button">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Provas -->
    <h2>Provas Enviadas</h2>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Denúncia</th>
                    <th>Arquivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($provas as $prova): ?>
                    <tr>
                        <td><?= htmlspecialchars($prova['denuncia_titulo']) ?></td>
                        <td><a href="<?= htmlspecialchars($prova['caminho_arquivo']) ?>" target="_blank" class="button">Ver Prova</a></td>
                        <td>
                            <a href="deletar_prova.php?id=<?= $prova['id'] ?>" onclick="return confirm('Deseja excluir esta prova?')" class="button">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div> <!-- Fim da main-content -->

</body>
</html>
