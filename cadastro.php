<?php
session_start();
include('includes/config.php'); // Deve conter a conexão PDO

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Corrige os nomes dos campos do formulário
    $nomecompleto = $_POST['nomecompleto'];
    $email = $_POST['email'];
    $senha = $_POST['Senha'];
    $confirmarsenha = $_POST['confirmarSenha'];

    if ($senha !== $confirmarsenha) {
        echo "<script>alert('As senhas não coincidem.');</script>";
    } else {
        try {
            // Verifica se o e-mail já existe
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Este e-mail já está cadastrado.');</script>";
            } else {
                // Criptografar a senha (recomenda-se password_hash)
                $senha_cripto = password_hash($senha, PASSWORD_DEFAULT);

                // Inserir o novo usuário
                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                $stmt->execute([$nomecompleto, $email, $senha_cripto]);

                echo "<script>alert('Cadastro realizado com sucesso!'); window.location='login.php';</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Erro no servidor: {$e->getMessage()}');</script>";
        }
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
        <img src="images/logo.svg" alt="Protection Violence Logo " />
      </div>
      <h1>Cadastrar-se</h1>
      <form id="register-form"  method="POST">
        <div class="input-box">
          <i class="ph ph-user"></i>
          <input type="text" name="nomecompleto" placeholder="Nome completo" required />
        </div>

        <div class="input-box">
          <i class="ph ph-at"></i>
          <input type="email" name="email" placeholder="email" required />
        </div>

        <div class="input-box">
          <i class="ph ph-lock"></i>
          <input type="password" name="Senha" placeholder="Insira a sua Senha" required />
        </div><div class="input-box">
          <i class="ph ph-lock"></i>
          <input type="password" name="confirmarSenha" placeholder="Confirme sua senha" required />
        </div>

        <button type="submit" name="Cadastrar">Cadastrar</button>
      </form>
      <div class="login-info">
        <p>Já tem uma conta? <a href="login.php">Login</a></p>
        <p><a href="home.php" id="visitorLink">Continuar como visitante</a></p>
      </div>
    </div>
  </body>
</html>
