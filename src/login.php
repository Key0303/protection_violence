<?php
$servername = "localhost";
$username = "root";
$password = ""; // Adicione a senha do MySQL aqui se tiver configurado uma
$dbname = "site_denuncias";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receber os dados do formulário
$user = $_POST['username'];
$pass = $_POST['password'];

// Verificar as credenciais
$sql = "SELECT id, password FROM usuarios WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $hashed_password);
    $stmt->fetch();
    
    if (password_verify($pass, $hashed_password)) {
        echo "Login realizado com sucesso!<br>";
        echo "<a href='denuncia.html'>Voltar à página inicial</a>";
    } else {
        echo "Senha incorreta. Tente novamente.<br>";
        echo "<a href='login.html'>Voltar ao login</a>";
    }
} else {
    echo "Usuário não encontrado. Tente novamente.<br>";
    echo "<a href='login.html'>Voltar ao login</a>";
}

$stmt->close();
$conn->close();
?>
