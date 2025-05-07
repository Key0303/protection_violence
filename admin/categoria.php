<?php
session_start();
include('includes/config.php');

// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'admin') {
    header("Location: ../login.php"); // Redireciona para a página de login
    exit;
}

// Adicionar nova categoria
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nova_categoria'])) {
    $nova_categoria = trim($_POST['nova_categoria']);
    if ($nova_categoria !== '') {
        $stmt = $conexao->prepare("INSERT INTO categorias (nome) VALUES (:nome)");
        $stmt->execute([':nome' => $nova_categoria]);
        $_SESSION['mensagem_sucesso'] = "Categoria adicionada com sucesso!";
        header("Location: categoria.php");
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
    <link rel="stylesheet" href="css/style.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; }
        th { background-color: #f9f9f9; }
        form { margin-top: 20px; }
        input[type="text"] { padding: 8px; width: 300px; }
        button { padding: 8px 16px; }
        .mensagem-sucesso {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 15px;
            margin-top: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php include('includes/header.php') ?>
<?php include('includes/sidebar.php') ?>

<div class="main-content">
    <h1>Gerenciar Categorias</h1>

    <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
        <div class="mensagem-sucesso">
            <?= $_SESSION['mensagem_sucesso'] ?>
            <?php unset($_SESSION['mensagem_sucesso']); ?>
        </div>
    <?php endif; ?>

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
