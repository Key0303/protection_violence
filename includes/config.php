<?php
define('host', 'localhost');
define('user', 'root');
define('pass', '');
define('dbname', 'protection_violence');

try {
    $conexao = new PDO('mysql:host=' . host . ';dbname=' . dbname, user, pass);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    echo "Erro ao conectar-se ao banco de dados: " . $erro->getMessage();
}
?>
