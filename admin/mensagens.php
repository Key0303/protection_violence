<?php
session_start();
include('includes/config.php');


// Verifica se o usuário está logado e se é um administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_tipo'] !== 'admin') {
    header("Location: ../login.php"); // Redireciona para a página de login
    exit;
}


// Buscar todas as mensagens de contato
$stmt = $conexao->prepare("SELECT * FROM mensagens_contato ORDER BY data_envio DESC");
$stmt->execute();
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Mensagens de Contato</title>
    <link rel="stylesheet" href="css/style.css" />
  
       
</head>
<body>

   <?php include('includes/header.php');?>
    <?php include('includes/sidebar.php');?>


    <div class="main-content">
        <h1>Mensagens de Contato</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Mensagem</th>
                        <th>Data de Envio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mensagens as $mensagem): ?>
                        <tr>
                            <td><?= htmlspecialchars($mensagem['nome']) ?></td>
                            <td><?= htmlspecialchars($mensagem['email']) ?></td>
                            <td><?= nl2br(htmlspecialchars($mensagem['mensagem'])) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($mensagem['data_envio'])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (count($mensagens) === 0): ?>
                        <tr>
                            <td colspan="4">Nenhuma mensagem encontrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
