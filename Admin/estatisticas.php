<?php
session_start();
include('includes/config.php');

// Verifica se o usuário está logado e é um administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Buscar todas as categorias
$stmt_categorias = $conexao->prepare("SELECT * FROM categorias");
$stmt_categorias->execute();
$categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

// Adicionar uma nova categoria
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nome'])) {
    $nome_categoria = $_POST['nome'];
    if (!empty($nome_categoria)) {
        $stmt = $conexao->prepare("INSERT INTO categorias (nome) VALUES (:nome)");
        $stmt->bindParam(':nome', $nome_categoria);
        $stmt->execute();
        header("Location: categorias.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Gerenciar Categorias - Sistema de Denúncias</title>
    <link rel="stylesheet" href="css/styles.css" />
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
        <h1>Gerenciar Categorias</h1>

        <!-- Formulário para Adicionar Categoria -->
        <h2>Adicionar Nova Categoria</h2>
        <form method="POST" action="categorias.php">
            <label for="nome">Nome da Categoria:</label>
            <input type="text" name="nome" id="nome" required />
            <button type="submit">Adicionar</button>
        </form>

        <!-- Exibição das Categorias -->
        <h2>Categorias Existentes</h2>
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
    </div>
</body>
</html>
