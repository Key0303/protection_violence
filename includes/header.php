<?php
session_start();
?>

<header>
    <nav>
      <div class="brand">
        <a href="/" class="nav-link text-white fs-6">
          <img src="images/logo.svg" />
          <h1 class="h4">Protection Violence</h1>
        </a>
      </div>
      <ul>
        <li class="nav-item"><a class="" href="home.php">Página inicial</a></li>
        <li class="nav-item">
          <a class="" href="denuncia.php">Denunciar</a>
        </li>
        <li class="nav-item">
          <a class="" href="contactos.php">Contactos</a>
        </li>
        <li class="nav-item"><a class="" href="sobrenos.php">Sobre nós</a></li>

        <!-- Verifica se o usuário está logado -->
        <?php if (isset($_SESSION['user_id'])): ?>
          <!-- Se estiver logado, exibe a opção de logout -->
          <li class="nav-item"><a class="" href="sair.php">Terminar Sessão</a></li>
        <?php else: ?>
          <!-- Se não estiver logado, exibe o link de login -->
          <li class="nav-item"><a class="" href="login.php" id="loginLink">Login</a></li>
        <?php endif; ?>
      </ul>
    </nav>
    <section id="swiper-section">
      <!-- Slider main container -->
      <div class="swiper" data-swiper-autoplay="2000">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <div class="slide-text">
              <p class="fs-3 w-50">
                Denuncie irregularidades de forma simples, segura e rápida.
                Juntos, podemos promover mudanças reais na nossa comunidade.
              </p>
              <button class="btn border border-0">Fazer denúncia</button>
            </div>
            <img src="images/slide-bg-03.png" alt="" />
          </div>
          <div class="swiper-slide">
            <div class="slide-text">
              <p class="fs-3 w-50">
                Denuncie com total anonimato. Seus dados estão protegidos e
                nunca serão compartilhados. Fale sem medo, nós garantimos sua
                privacidade.
              </p>
              <button class="btn border border-0">Fazer denúncia</button>
            </div>
            <img src="images/slide-bg-02.png" alt="" />
          </div>
          <div class="swiper-slide">
            <div class="slide-text">
              <p class="fs-3 w-50">
                Seja parte da solução. Ajude a combater injustiças, abusos e
                crimes. Sua denúncia pode proteger vidas e transformar
                realidades.
              </p>
              <button class="btn border border-0">Fazer denúncia</button>
            </div>
            <img src="images/slide-bg-04.png" alt="" />
          </div>
        </div>
      </div>
    </section>
</header>
