<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site_denuncias";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Receber os dados do formulário
$user = $_POST['username'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash da senha

// Inserir os dados na tabela
$sql = "INSERT INTO usuarios (username, email, password) VALUES ('$user', '$email', '$pass')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso!<br>";
    echo "<a href='index.html'>Cadastrar outro usuário</a><br>";
    echo "<a href='consulta.php'>Ver usuários cadastrados</a>";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
