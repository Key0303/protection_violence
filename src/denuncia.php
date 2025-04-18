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
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];

// Inserir os dados na tabela
$sql = "INSERT INTO denuncias (categoria, descricao) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $categoria, $descricao);

if ($stmt->execute()) {
    echo "Denúncia enviada com sucesso!<br>";
    echo "<a href='denuncia.html'>Enviar outra denúncia</a>";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>