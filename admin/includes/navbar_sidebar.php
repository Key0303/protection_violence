<?php
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Protection Violence</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="perfil.php"><i class="bi bi-person-circle"></i> Perfil</a></li>
                <li class="nav-item"><a class="nav-link" href="sair.php"><i class="bi bi-box-arrow-right"></i> Sair</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="d-flex">
    <nav class="bg-light sidebar">
        <ul class="nav flex-column p-3">
            <li class="nav-item"><a class="nav-link" href="denuncias.php"><i class="bi bi-file-earmark-text"></i> Denúncias</a></li>
            <li class="nav-item"><a class="nav-link" href="estatisticas.php"><i class="bi bi-bar-chart"></i> Relatórios</a></li>
            <li class="nav-item"><a class="nav-link" href="perfil.php"><i class="bi bi-person-circle"></i> Usuários</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-gear"></i> Configurações</a></li>
            <li class="nav-item"><a class="nav-link" href="#"><i class="bi bi-shield-lock"></i> Agente da Lei</a></li>
        </ul>
    </nav>';
?>