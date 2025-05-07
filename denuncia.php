<?php
session_start();
include('includes/config.php'); // Conexão PDO com $pdo

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit;
}

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $anonima = isset($_POST['anonima']) ? (int) $_POST['anonima'] : 0;
    $tem_prova = isset($_POST['tem_prova']) ? (int) $_POST['tem_prova'] : 0;
    $usuario_id = $_SESSION['user_id'];

    // Variável para armazenar o caminho da prova
    $prova_caminho = null;

    // Verifica se foi enviado um arquivo de prova
    if ($tem_prova && isset($_FILES['arquivo_prova']) && $_FILES['arquivo_prova']['error'] === UPLOAD_ERR_OK) {
        $nome_tmp = $_FILES['arquivo_prova']['tmp_name'];
        $nome_arquivo = time() . '_' . basename($_FILES['arquivo_prova']['name']);
        $destino = 'uploads/' . $nome_arquivo;

        // Move o arquivo para o diretório de uploads
        if (move_uploaded_file($nome_tmp, $destino)) {
            $prova_caminho = $destino;
        } else {
            echo "Erro ao mover o arquivo para o diretório de destino.";
            exit;
        }
    }

    try {
        // Buscar o nome de usuário com base no ID do usuário
        $stmt_usuario = $conexao->prepare("SELECT nome FROM usuarios WHERE id = :usuario_id");
        $stmt_usuario->execute([':usuario_id' => $usuario_id]);
        $usuario = $stmt_usuario->fetch(PDO::FETCH_ASSOC);

        // Verifica se o nome de usuário foi encontrado
        if ($usuario) {
            $usuario_nome = $usuario['nome'];

            // Inserir a denúncia associada ao nome de usuário
            $stmt = $conexao->prepare("INSERT INTO denuncias (usuario_id, titulo, descricao, categoria_id, anonima, status)
            VALUES (:usuario_id, :titulo, :descricao, 
                                          (SELECT id FROM categorias WHERE nome = :categoria), :anonima, 'pendente')");
            $stmt->execute([
                ':usuario_id' => $anonima ? null : $usuario_id,
                ':titulo' => $categoria . " - " . substr($descricao, 0, 50),
                ':descricao' => $descricao,
                ':categoria' => $categoria,
                ':anonima' => $anonima
            ]);

            $denuncia_id = $conexao->lastInsertId();

            // Se houver prova, insere no banco de dados
            if ($prova_caminho) {
                $stmt_prova = $conexao->prepare("INSERT INTO provas (denuncia_id, caminho_arquivo) VALUES (?, ?)");
                $stmt_prova->execute([$denuncia_id, $prova_caminho]);
            }

            // Exibe mensagem de sucesso e redireciona para a página inicial
            echo "<script>alert('Denúncia enviada com sucesso!'); window.location='home.php';</script>";
        } else {
            echo "Erro ao buscar o nome de usuário.";
        }

    } catch (PDOException $e) {
        echo "Erro ao enviar denúncia: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <title>Denunciar - Site de Denúncias</title>
  <link rel="stylesheet" href="./css/styles1.css" />
</head>
<body>
  <div class="container">
    <h1>Denuncie agora!</h1>
    <form id="denunciaForm" method="POST" enctype="multipart/form-data">
      <div class="select-box">
        <label for="categoria">Categoria:</label>
        <select id="categoria" name="categoria" required>
          <option value="">Selecione</option>
          <?php
          // Busca as categorias do banco de dados
          $stmt_categorias = $conexao->prepare("SELECT nome FROM categorias");
          $stmt_categorias->execute();
          $categorias = $stmt_categorias->fetchAll(PDO::FETCH_ASSOC);

          // Exibe as opções de categoria
          foreach ($categorias as $categoria) {
              echo "<option value='{$categoria['nome']}'>{$categoria['nome']}</option>";
          }
          ?>
        </select>
      </div>

      <div class="textarea-box">
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>
      </div>

      <div class="prova">
        <p>Tem alguma prova?</p>
        <input type="radio" name="tem_prova" value="1" required /> Sim
        <input type="radio" name="tem_prova" value="0" /> Não

        <div class="input-box">
          <input type="file" name="arquivo_prova" />
        </div>

        <p>Deseja manter sua denúncia anônima?</p>
        <input type="radio" name="anonima" value="1" required /> Sim
        <input type="radio" name="anonima" value="0" /> Não
      </div>

      <div class="form-info">
        <p><a href="consultar.php">Consultar denúncia</a></p>
        <p><a href="home.php">Voltar à página inicial</a></p>
      </div>

      <button type="submit" name="enviar">Enviar Denúncia</button>
    </form>
  </div>
</body>
</html>
