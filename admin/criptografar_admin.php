<?php
include('includes/config.php'); // conexão com $conexao

// Nome do usuário admin e nova senha
$nomeusuario = 'Violeta@22';  // Nome exato cadastrado no banco
$novaSenha = 'protecao123'; // Altere para a senha desejada

// Criptografa a senha
$senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

try {
    // Atualiza a senha criptografada no banco de dados
    $stmt = $conexao->prepare("UPDATE usuarios SET senha = :senha WHERE nome = :nomeusuario");
    $stmt->execute([
        ':senha' => $senhaCriptografada,
        ':nomeusuario' => $nomeusuario
    ]);

    echo "Senha do administrador atualizada com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao atualizar a senha: " . $e->getMessage();
}
?>
