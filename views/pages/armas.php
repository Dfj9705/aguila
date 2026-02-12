<!-- Page Header Start -->
<div class="container-fluid page-header py-5 wow animate__animated animate__fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5 mt-4">
        <h1 class="display-2 text-white mb-3 animated slideInDown">Armas</h1>
    </div>
</div>
<!-- Page Header End -->
<div class="container-fluid container-service py-5 text-dark">
    <div class="row">
        <div class="col-lg-2" style="max-height: 50vh; overflow-y: auto;">
            <h6>Filtros</h6>
            <div class="accordion accordion-flush bg-light" id="accordionExample">
                <div class="accordion-item bg-light">
                    <h2 class="accordion-header text-dark">
                        <button class="accordion-button collapsed bg-light text-dark" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false"
                            aria-controls="collapseOne">
                            Marcas
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <?php foreach ($marcas as $marca): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                    <label class="form-check-label" for="checkDefault">
                                        <?php echo $marca['name']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item bg-light">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light text-dark" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                            aria-controls="collapseTwo">
                            Modelos
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <?php foreach ($modelos as $modelo): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                    <label class="form-check-label" for="checkDefault">
                                        <?php echo $modelo['name']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item bg-light">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light text-dark" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false"
                            aria-controls="collapseThree">
                            Calibres
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <?php foreach ($calibres as $calibre): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                    <label class="form-check-label" for="checkDefault">
                                        <?php echo $calibre['name']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="accordion-item bg-light">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed bg-light text-dark" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false"
                            aria-controls="collapseFour">
                            Tipo de arma
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <?php foreach ($tipos_arma as $tipo_arma): ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                    <label class="form-check-label" for="checkDefault">
                                        <?php echo $tipo_arma['name']; ?>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-10" id="armasDiv">

        </div>
    </div>
</div>

<script src="<?php echo $_ENV['HOST']; ?>/build/js/pages/armas.js"></script>