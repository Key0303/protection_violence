<?php
session_start();

// Destroi a sessão
session_destroy();

// Redireciona o usuário para a página inicial (ou login)
header("Location: home.php");
exit;
?>
