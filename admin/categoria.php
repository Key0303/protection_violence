<?php
session_start();
include('includes/config.php');

// Verifica se o usuário está logado e é um administrador
// Adicionar nova categoria
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nova_categoria'])) {
    $nova_categoria = trim($_POST['nova_categoria']);
    if ($nova_categoria !== '') {
        $stmt = $conexao->prepare("INSERT INTO categorias (nome) VALUES (:nome)");
        $stmt->execute([':nome' => $nova_categoria]);
        header("Location: categorias.php");
        exit;
    }
}

// Buscar categorias existentes
$stmt = $conexao->prepare("SELECT * FROM categorias ORDER BY nome ASC");
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Categorias - Admin</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; }
        th { background-color: #f9f9f9; }
        form { margin-top: 20px; }
        input[type="text"] { padding: 8px; width: 300px; }
        button { padding: 8px 16px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            <li><a href="dashboard.php">Início</a></li>
            <li><a href="categorias.php" class="active">Categorias</a></li>
            <li><a href="usuarios.php">Usuários</a></li>
            <li><a href="mensagens.php">Mensagens de Contato</a></li>
            <li><a href="logout.php">Sair</a></li>
        </ul>
    </div>

    <div class="main-content">
        <h1>Gerenciar Categorias</h1>

        <form method="POST" action="">
            <label for="nova_categoria">Nova Categoria:</label><br>
            <input type="text" name="nova_categoria" id="nova_categoria" required>
            <button type="submit">Adicionar</button>
        </form>

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
                        <td><?= htmlspecialchars($categoria['nome']) ?></td>
                        <td>
                            <a href="editar_categoria.php?id=<?= $categoria['id'] ?>">Editar</a> |
                            <a href="deletar_categoria.php?id=<?= $categoria['id'] ?>" onclick="return confirm('Deseja excluir esta categoria?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
