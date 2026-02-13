<!-- Page Header Start -->
<div class="container-fluid page-header py-5 wow animate__animated animate__fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5 mt-4">
        <h1 class="display-2 text-white mb-3 animated slideInDown">Municiones</h1>
    </div>
</div>
<!-- Page Header End -->
<div class="container-fluid container-service py-5 text-dark">
    <div class="row">
        <div class="col-lg-2" style="max-height: 60vh; overflow-y: auto;">
            <h6>Filtros</h6>
            <form id="formFiltros" class="mb-3">
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
                                        <input class="form-check-input" type="checkbox" value="<?php echo $marca['id']; ?>"
                                            id="marca-<?php echo $marca['id']; ?>" name="marcas[]">
                                        <label class="form-check-label" for="marca-<?php echo $marca['id']; ?>">
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
                                Calibres
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse">
                            <div class="accordion-body">
                                <?php foreach ($calibres as $calibre): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox"
                                            value="<?php echo $calibre['id']; ?>"
                                            id="calibre-<?php echo $calibre['id']; ?>" name="calibres[]">
                                        <label class="form-check-label" for="calibre-<?php echo $calibre['id']; ?>">
                                            <?php echo $calibre['name']; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
            <a href="<?php echo $_ENV['HOST']; ?>/productos" class="btn btn-primary w-100" id="btnVolver"><i
                    class="bi bi-arrow-left me-2"></i>Volver a
                productos</a>
        </div>

        <div class="col-lg-10">
            <div class="spinner-border text-primary d-none" role="status" id="spinner2">
                <span class="visually-hidden">Loading...</span>
            </div>
            <div id="municionesDiv"></div>
        </div>
    </div>
</div>

<script src="<?php echo $_ENV['HOST']; ?>/build/js/pages/municiones.js"></script>