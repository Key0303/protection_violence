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

    <div class="container testimonial-section mt-3 mb-5">
    <h5 class="text-secondary text-center mb-3">Vê o que os outros pensam sobre a violência</h5>
    <h2 class="fw-bold text-center mb-4">Testemunhos</h2>
    
    <section class="testemunhos">
        <div class="row justify-content-center">
            <!-- Left Testimonial -->
            <div class="col-md-4 d-flex justify-content-center mb-4 mb-md-0">
                <div class="testimonial-card text-center">
                    <p class="testimonial-text">
                        "A violência nunca é a solução. Cada ato de agressão gera mais sofrimento e separação. Devemos buscar o diálogo e a compreensão para resolver nossos conflitos."
                    </p>
                    <img src="https://randomuser.me/api/portraits/women/12.jpg" alt="Maria" class="profile-img rounded-circle mb-3"/>
                    <div class="testimonial-author fw-bold">Maria Silva</div>
                    <div class="testimonial-role text-muted">Psicóloga</div>
                </div>
            </div>

            <!-- Center Testimonial (Highlighted) -->
            <div class="col-md-4 d-flex justify-content-center mb-4 mb-md-0">
                <div class="testimonial-card main text-center p-4 border border-3 rounded shadow-lg">
                    <p class="testimonial-text">
                        "Cresci em um ambiente violento e sei o quão devastador é viver com medo. A violência destrói vidas, enquanto o amor e a paz constroem futuros melhores."
                    </p>
                    <img src="https://randomuser.me/api/portraits/women/18.jpg" alt="Lucas" class="profile-img rounded-circle mb-3"/>
                    <div class="testimonial-author fw-bold">Lucas Santos</div>
                    <div class="testimonial-role text-muted">Educador</div>
                </div>
            </div>

            <!-- Right Testimonial -->
            <div class="col-md-4 d-flex justify-content-center mb-4 mb-md-0">
                <div class="testimonial-card text-center">
                    <p class="testimonial-text">
                        "A violência nunca resolve os problemas; ao contrário, só agrava a situação. Devemos cultivar a empatia e a solidariedade para promover uma sociedade mais justa e pacífica."
                    </p>
                    <img src="https://randomuser.me/api/portraits/women/22.jpg" alt="Carlos" class="profile-img rounded-circle mb-3"/>
                    <div class="testimonial-author fw-bold">Carlos Oliveira</div>
                    <div class="testimonial-role text-muted">Ativista</div>
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
