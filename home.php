<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Home - Site de Denúncias</title>
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/styles_img.css" />
    <link rel="stylesheet" href="assets/package/swiper-bundle.min.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <script src="https://unpkg.com/@phosphor-icons/web@2.1.1"></script>
  </head>
  <body>
    <?php include('includes/header.php'); ?>

    <div class="container d-flex flex-row testimonial-section">
        <h5 class="text-secondary">Vê o que os outros pensam sobre a violência</h5>
        <h2 class="fw-bold">Testemunhos</h2>
        <section class="testemunhos">
            <div class="row justify-content-center">
                <!-- Left Testimonial -->
                <div class="col-md-4 d-flex justify-content-end">
                    <div class="testimonial-card text-center">
                        <p class="testimonial-text">
                            "A nova OptinMonster com o back-end da web é simplesmente incrível. Fácil de usar e uma maneira muito eficaz de aumentar os inscritos."
                        </p>
                        <img
                          src="https://randomuser.me/api/portraits/women/12.jpg"
                          alt="Jane"
                          class="profile-img"
                        />
                        <div class="testimonial-author">Jane Rowling</div>
                        <div class="testimonial-role">Copywriter</div>
                    </div>
                </div>

                <!-- Center Testimonial (Highlighted) -->
                <div class="col-md-4 d-flex justify-content-center">
                    <div class="testimonial-card main text-center">
                        <p class="testimonial-text">
                            "Eu era uma descrente! Não gostava de pop-ups. Mas dobramos nossas inscrições por e-mail. O OptinMonster facilita muito."
                        </p>
                        <img
                          src="https://randomuser.me/api/portraits/women/18.jpg"
                          alt="Emilia"
                          class="profile-img"
                        />
                        <div class="testimonial-author">Emilia Bubu</div>
                        <div class="testimonial-role">UI/UX Designer</div>
                    </div>
                </div>

                <!-- Right Testimonial -->
                <div class="col-md-4 d-flex justify-content-start">
                    <div class="testimonial-card text-center">
                        <p class="testimonial-text">
                            "OptinMonster trouxe mais inscritos para mim. Configurá-lo foi tranquilo e excelente! Eu amo o produto e as pessoas por trás dele."
                        </p>
                        <img
                          src="https://randomuser.me/api/portraits/women/22.jpg"
                          alt="Judy"
                          class="profile-img"
                        />
                        <div class="testimonial-author">Judy Dawson</div>
                        <div class="testimonial-role">PHP Developer</div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php include('includes/footer.php'); ?>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
  var swiper = new Swiper('.swiper-container', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 10,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
  });
</script>

  </body>
</html>
