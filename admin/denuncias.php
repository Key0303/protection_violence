<?php
include('includes/config.php');


// Verificar se o usuário está logado
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Obter as denúncias do banco de dados
$denuncias = getDenuncias($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração - Denúncias</title>
    <!-- Incluindo o CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!-- Incluindo ícones do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

    <!-- Barra superior (Navbar) -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Protection Violence</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="perfil.php">
                            <i class="bi bi-person-circle"></i> Perfil
                        </a>
                    </li>
                    <!-- Removido o botão "Sair" da Navbar -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Início do layout do painel de administração -->
    <div class="container mt-5 pt-5">
        <h2>Denúncias Recebidas</h2>

        <!-- Tabela de denúncias -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome do Denunciante</th>
                        <th>Assunto</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($denuncias as $denuncia): ?>
                    <tr>
                        <td><?php echo $denuncia['id']; ?></td>
                        <td><?php echo $denuncia['nome_denunciante']; ?></td>
                        <td><?php echo $denuncia['assunto']; ?></td>
                        <td><span class="badge <?php echo ($denuncia['status'] == 'Pendente') ? 'bg-warning' : ($denuncia['status'] == 'Resolvido' ? 'bg-success' : 'bg-danger'); ?>"><?php echo $denuncia['status']; ?></span></td>
                        <td>
                            <a href="ver_denuncia.php?id=<?php echo $denuncia['id']; ?>" class="btn btn-info btn-sm"><i class="bi bi-eye"></i> Ver</a>
                            <a href="resolver_denuncia.php?id=<?php echo $denuncia['id']; ?>" class="btn btn-success btn-sm"><i class="bi bi-check-circle"></i> Resolver</a>
                            <a href="excluir_denuncia.php?id=<?php echo $denuncia['id']; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Excluir</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Botão de "Adicionar Denúncia" -->
        <a href="adicionar_denuncia.php" class="btn btn-primary btn-sm mt-3"><i class="bi bi-plus-circle"></i> Adicionar Denúncia</a>
    </div>

    <!-- Scripts do Bootstrap (JavaScript e Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
