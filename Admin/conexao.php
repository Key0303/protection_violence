<?php
define('host','localhost');
define('user','root');
define('pass','');
define('dbname','protection_violence');

try {
    $conexao = new PDO('mysql:host=localhost;dbname=protection_violence', 'root', '');
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>