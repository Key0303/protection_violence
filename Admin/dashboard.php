<?php
session_start();
include('includes/config.php');

// Verifica se o usuário está logado e é um administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Buscar todas as denúncias
$stmt_denuncias = $conexao->prepare("SELECT d.id, d.titulo, d.status, u.nome AS usuario_nome, c.nome AS categoria_nome FROM denuncias d JOIN usuarios u ON d.usuario_id = u.idJOIN categorias c ON d.categoria_id = c.id");
$stmt_denuncias->execute();
$denuncias = $stmt_denuncias->fetchAll(PDO::FETCH_ASSOC);

// Buscar todas as categorias
$stmt_categorias = $conexao->prepare("SELECT * FROM categorias");
$stmt_categorias->execute();
$categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

// Buscar todas as provas
$stmt_provas = $conexao->prepare("SELECT p.id, p.caminho_arquivo, d.titulo AS denuncia_titulo
                                FROM provas p
                                JOIN denuncias d ON p.denuncia_id = d.id");
$stmt_provas->execute();
$provas = $stmt_provas->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Dashboard - Sistema de Denúncias</title>
    <link rel="stylesheet" href="css/styles.css" />
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
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
        <h1>Dashboard de Denúncias</h1>
        
        <!-- Exibição das Denúncias -->
        <h2>Denúncias</h2>
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
                        <td><?php echo $denuncia['titulo']; ?></td>
                        <td><?php echo $denuncia['categoria_nome']; ?></td>
                        <td><?php echo $denuncia['usuario_nome']; ?></td>
                        <td><?php echo ucfirst($denuncia['status']); ?></td>
                        <td>
                            <a href="ver_denuncia.php?id=<?php echo $denuncia['id']; ?>">Ver</a> |
                            <a href="resolver_denuncia.php?id=<?php echo $denuncia['id']; ?>">Resolver</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Exibição das Categorias -->
        <h2>Categorias de Denúncias</h2>
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
                        <td><?php echo $categoria['nome']; ?></td>
                        <td>
                            <a href="editar_categoria.php?id=<?php echo $categoria['id']; ?>">Editar</a> |
                            <a href="deletar_categoria.php?id=<?php echo $categoria['id']; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Exibição das Provas -->
        <h2>Provas Enviadas</h2>
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
                        <td><?php echo $prova['denuncia_titulo']; ?></td>
                        <td><a href="<?php echo $prova['caminho_arquivo']; ?>" target="_blank">Ver Prova</a></td>
                        <td>
                            <a href="deletar_prova.php?id=<?php echo $prova['id']; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
