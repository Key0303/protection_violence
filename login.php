<?php
session_start();
include('includes/config.php'); 

if (isset($_POST)) {
    $nomeusuario = $_POST['nomeusuario'];
    $senha = $_POST['Senha'];

   
    $stmt = $conexao->prepare("SELECT id, senha FROM usuarios WHERE nome = :nomeusuario");
    $stmt->execute([':nomeusuario' => $nomeusuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($senha, $usuario['senha'])) {
     
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_nome'] = $nomeusuario;
        

        header("Location: home.php");
        exit;
    } else {
       
        $erro = "Nome de usuário ou senha incorretos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro - Site de Denúncias</title>
    <link rel="stylesheet" href="css/styles1.css" />
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
</head>
<style>
    body{
        background:rgba(139, 27, 111, 0.79);
    }
</style>
<body>
    <div class="login-container">
        <div class="brand-login">
            <img src="images/logo.svg" alt="Protection Violence Logo" />
        </div>
        <h1>Entrar</h1>

        <?php if (isset($erro)): ?>
            <div class="error-message"><?php echo $erro; ?></div>
        <?php endif; ?>

        <form id="register-form" method="POST">
            <div class="input-box">
                <i class="ph ph-user"></i>
                <input type="text" name="nomeusuario" placeholder="Nome de Usuário" required />
            </div>

            <div class="input-box">
                <i class="ph ph-lock"></i>
                <input type="password" name="Senha" placeholder="Insira a sua Senha" required />
            </div>

            <button type="submit" name="Entrar">Entrar</button>
        </form>

        <div class="login-info">
            <p>Ainda não tem conta? <a href="cadastro.php">Criar conta</a></p>
            <p><a href="home.php" id="visitorLink">Continuar como visitante</a></p>
        </div>
    </div>
</body>
</html>
