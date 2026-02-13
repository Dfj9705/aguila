<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="utf-8">
        <meta name="theme-color" content="#556B2F">
        <title><?= $_ENV['APP_NAME'] ?></title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta name="description" content="Sitio web de Armeria Águila Comandos">
        <meta name="keywords"
            content="armas, municiones, escopetas, rifles, pistolas, navajas, linternas, miras, binoculares, ropa, calzado, equipo táctico, accesorios, seguridad, defensa, tiro deportivo, caza, airsoft, paintball, entrenamiento, cursos, capacitación, armas de fuego, municiones, accesorios, seguridad, defensa, tiro deportivo, caza, airsoft, paintball, entrenamiento, cursos, capacitación">
        <meta name="robots" content="index, follow">
        <link rel="canonical" href="<?= $_ENV['HOST'] ?>">

        <meta property="og:title" content="Armeria Águila Comandos">
        <meta property="og:description" content="Sitio web de Armeria Águila Comandos">
        <meta property="og:image" content="<?= $_ENV['HOST'] ?>/images/logo.jpeg">
        <meta property="og:url" content="<?= $_ENV['HOST'] ?>">
        <meta property="og:type" content="website">
        <meta property="og:image:width" content="300">
        <meta property="og:image:height" content="300">

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Armeria Águila Comandos">
        <meta name="twitter:description" content="Sitio web de Armeria Águila Comandos">
        <meta name="twitter:image" content="<?= $_ENV['HOST'] ?>/images/logo.jpeg">
        <meta name="twitter:url" content="<?= $_ENV['HOST'] ?>">

        <meta http-equiv="Content-Language" content="es">

        <meta content="" name="description">

        <meta name="author" content="Abner Daniel Fuentes Juárez">


        <!-- Favicon -->
        <link href="<?= $_ENV['HOST'] ?>/images/logo.png" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Red+Rose:wght@600;700&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

        <link rel="stylesheet" href="<?= $_ENV['HOST'] ?>/build/css/styles.css">
    </head>

    <body>
        <!-- Spinner Start -->
        <div id="spinner"
            class="show position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex flex-column align-items-center justify-content-center bg-dark text-white-50">
            <div class="spinner-grow text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
            <p>Águila Comandos</p>
        </div>
        <!-- Spinner End -->



        <!-- Brand Start -->
        <div class="container-fluid pt-4 pb-5 d-none d-lg-flex bg-dark text-white-50">
            <div class="container pb-2">
                <div class="d-flex align-items-center justify-content-between">
                    <a href="/" class="h1 text-decoration-none fst-italic mb-0  text-white"><img src="/images/logo.png"
                            alt="" width="60px"><span class="align-middle">Águila
                            Comandos</span></a>
                    <small></small>


                    <div class="d-flex">
                        <p class="me-3"><span class="align-middle"><i class="bi bi-whatsapp me-2"></i>+502
                                32832297</span></p>
                        <p><span class="align-middle"><i
                                    class="bi bi-envelope me-2"></i><?= $_ENV['EMAIL_TO_ADDRESS'] ?></span>

                    </div>

                </div>
            </div>
        </div>
        <!-- Brand End -->


        <!-- Navbar Start -->
        <div class="container-fluid sticky-top bg-dark">
            <div class="container">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark text-white-50 py-lg-0 px-0 px-lg-3">
                    <a href="/" class="h2 text-decoration-none d-lg-none fst-italic mb-0  text-white"><img
                            src="/images/logo.png" alt="" width="60px"><span class="align-middle">Águila
                            Comandos</span></a>
                    <button type="button" class="navbar-toggler me-0 text-white-50" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="navbar-toggler-icon bg-dark text-white"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <div class="navbar-nav">
                            <a href="/" class="nav-item nav-link">Inicio</a>
                            <a href="/mision-vision" class="nav-item nav-link">Misión y Visión</a>
                            <a href="/quienes-somos" class="nav-item nav-link">Quienes somos</a>
                            <a href="/productos" class="nav-item nav-link">Productos</a>
                            <a href="/contacto" class="nav-item nav-link">Contáctenos</a>
                        </div>
                        <div class="ms-auto d-none d-lg-flex">
                            <a class="btn btn-sm-square btn-primary ms-2" target="_blank" aria-label="Enlace a Facebook"
                                href="https://www.facebook.com/share/1NmhsiXEEs/?mibextid=wwXIfr"><i
                                    class="bi bi-facebook"></i><span class="d-none">Enlace a Facebook</span></a>
                            <a class="btn btn-sm-square btn-primary ms-2" target="_blank" aria-label="Enlace a Facebook"
                                href="https://www.facebook.com/share/18EFKQPoRt/?mibextid=wwXIfr
"><i class="bi bi-facebook"></i><span class="d-none">Enlace a Facebook</span></a>
                            <a class="btn btn-sm-square btn-primary ms-2"
                                href="https://www.instagram.com/aguilacomandos?igsh=YmZvMHZtZXFmMWNl"
                                target="__blank"><i class="bi bi-instagram"></i></a>
                            <a class="btn btn-sm-square btn-primary ms-2"
                                href="https://www.tiktok.com/@aguilacomandos?_r=1&_t=ZS-93qR40QmavM" target="__blank"><i
                                    class="bi bi-tiktok"></i></a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Navbar End -->

        <?= $contenido ?>

        <!-- Footer Start -->
        <div class="container-fluid position-relative py-2 wow animate__animated animate__fadeIn bg-dark"
            data-wow-delay="0.1s">
            <div class="container">
                <div class="row g-5 py-5">
                    <div class="col-lg-12 pe-lg-5">
                        <a href="/" class="text-white text-decoration-none">
                            <h1 class="h1 mb-0 fst-italic">Águila Comandos</h1>
                        </a>
                        <p class="fs-6 mb-4 fst-italic text-white">Donde la precisión, la pasión y la protección se
                            encuentran
                        </p>

                        <p><a class="text-decoration-none text-white-50" href="tel:+50277367641"><i
                                    class="fa fa-phone-alt me-2"></i>+502 77367641</p></a>
                        <p><a class="text-decoration-none text-white-50"
                                href="https://wa.me/50232832297?text=Hola,%20quiero%20más%20información"><i
                                    class="fa fa-whatsapp me-2"></i>+502 32832297</p></a>
                        <p><a class="text-decoration-none text-white-50"
                                href="mailto:<?= $_ENV['EMAIL_TO_ADDRESS'] ?>"><i
                                    class="fa fa-envelope me-2"></i><?= $_ENV['EMAIL_TO_ADDRESS'] ?></p></a>
                        <p><a class="text-decoration-none text-white-50" target="_blank"
                                href="https://www.google.com/maps/dir/?api=1&destination=armeria%20aguila%20comandos%2C%20jutiapa%2C%20jutiapa"><i
                                    class="fa fa-map-marker-alt me-2"></i>Calle escuela, zona 0, local A, Jutiapa,
                                Jutiapa</p></a>
                        <div class="d-flex mt-4">
                            <a class="btn btn-lg-square btn-primary me-2"
                                href="https://www.facebook.com/share/1NmhsiXEEs/?mibextid=wwXIfr" target="__blank"><i
                                    class="bi bi-facebook"></i></a>
                            <a class="btn btn-lg-square btn-primary me-2"
                                href="https://www.facebook.com/share/18EFKQPoRt/?mibextid=wwXIfr" target="__blank"><i
                                    class="bi bi-facebook"></i></a>
                            <a class="btn btn-lg-square btn-primary me-2"
                                href="https://www.instagram.com/aguilacomandos?igsh=YmZvMHZtZXFmMWNl"
                                target="__blank"><i class="bi bi-instagram"></i></a>
                            <a class="btn btn-lg-square btn-primary me-2"
                                href="https://www.tiktok.com/@aguilacomandos?_r=1&_t=ZS-93qR40QmavM" target="__blank"><i
                                    class="bi bi-tiktok"></i></a>
                            <!-- <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-lg-square btn-primary me-2" href="#"><i class="fab fa-instagram"></i></a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Copyright Start -->
        <div class="container-fluid copyright bg-primary text-white-50 py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-0 text-center">&copy; Procode Innovations GT <?= date('Y') ?></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top d-flex align-items-center"
            aria-label="Subir en la página"><i class="fas fa-arrow-up"></i><span class="d-none">Subir</span></a>


        <!-- JavaScript Libraries -->
        <script defer src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script defer src="https://kit.fontawesome.com/0ac58cc75c.js"></script>
        <!-- Template Javascript -->
        <script src="<?= $_ENV['HOST'] ?>/build/js/app.js"></script>
        <script src="<?= $_ENV['HOST'] ?>/build/js/main.js"></script>
    </body>

</html>