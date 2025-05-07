<?php
define('host','localhost');
define('user','root');
define('pass','');
define('dbname','protection_violence');

try {
    $conexao = new PDO('mysql:host=localhost;dbname=protection_violence', 'root', '');
} catch (PDOException $e) {
    echo("Erro na conexão: " . $e->getMessage());
}
?>