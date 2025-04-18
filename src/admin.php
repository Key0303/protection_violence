<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

require 'config.php';

$result = $conn->query("SELECT * FROM denuncias");

echo "<h1>Denúncias Recebidas</h1>";
echo "<table border='1'>
<tr>
<th>ID</th>
<th>Descrição</th>
<th>Categoria</th>
<th>Data</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['descricao'] . "</td>";
    echo "<td>" . $row['categoria'] . "</td>";
    echo "<td>" . $row['data'] . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "<a href='logout.php'>Logout</a>";

$conn->close();
?>