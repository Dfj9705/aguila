<?php
$title = '';
$price = 0;
$badges = '';
switch ($tipo) {
    case 'armas':
        $title = $producto['brand'] . ' ' . $producto['model'] . ' ' . $producto['caliber'] . ' ' . $producto['weapon_type'];
        $price = $producto['price'];
        $badges =
            (isset($producto['magazine_capacity']) && $producto['magazine_capacity'] > 0 ? "<span class='badge bg-primary'>{$producto['magazine_capacity']} rounds</span>" : '') .
            (isset($producto['barrel_length_mm']) && $producto['barrel_length_mm'] > 0 ? "<span class='badge bg-primary'>{$producto['barrel_length_mm']} mm</span>" : '') .
            (isset($producto['color_text']) && $producto['color_text'] ? "<span class='badge' style='background-color: {$producto['color']}; color: white;'>{$producto['color_text']}</span>" : '');
        break;
    case 'municiones':
        $title = $producto['brand'] . ' ' . $producto['caliber'];
        $price = $producto['price_per_box'];

        break;
    case 'accesorios':
        $title = $producto['brand'] . ' ' . $producto['name'];
        $price = $producto['unit_price'];
        break;
    default:
        # code...
        break;
}
?>
<div class="container-fluid page-header py-5 wow animate__animated animate__fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5 mt-4">
        <h1 class="display-2 text-white mb-3 animated slideInDown">
            <?php echo $title; ?>
        </h1>
    </div>
</div>
<div class="container container-team py-5">
    <div class="row justify-content-around">
        <div class="col-md-5">
            <?php $images = json_decode($producto['images'], true); ?>
            <?php if (count($images) > 0): ?>
                <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php foreach ($images as $index => $image): ?>
                            <button type="button" data-bs-target="#productCarousel" data-bs-slide-to="<?php echo $index; ?>"
                                class="<?php echo $index === 0 ? 'active' : ''; ?>"
                                aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>"
                                aria-label="Slide <?php echo $index + 1; ?>"></button>
                        <?php endforeach; ?>
                    </div>
                    <div class="carousel-inner">
                        <?php foreach ($images as $index => $image): ?>
                            <?php $imgUrl = $_ENV['IMAGES_URL'] . $image; ?>
                            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <a onclick="return false;" href="<?php echo $imgUrl; ?>" class="glightbox-product d-block"
                                    data-gallery="product-<?php echo $producto['id'] ?? '1'; ?>"
                                    data-title="<?php echo htmlspecialchars($title); ?>">
                                    <img src="<?php echo $imgUrl; ?>" class="d-block w-100"
                                        alt="<?php echo htmlspecialchars($title); ?>" style="cursor: zoom-in;">
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            <?php else: ?>
                <img src="<?= $_ENV['HOST'] . "/images/no-image.png" ?>" class="d-block w-100"
                    alt="<?php echo htmlspecialchars($title); ?>" style="cursor: zoom-in;">
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <h2>
                <?php echo $title; ?>
            </h2>
            <p>
                <?php echo $producto['description']; ?>
            </p>
            <p>
                <strong>Precio:</strong>
                <span class="badge bg-primary"><?php echo $price; ?></span>
            </p>
            <p>
                <strong>Stock:</strong>
                <span
                    class="badge <?php echo $producto['stock'] > 0 ? 'bg-success' : 'bg-danger'; ?>"><?php echo $producto['stock'] > 0 ? 'Disponible' : 'No disponible'; ?></span>
            </p>
            <p>
                <?php echo $badges; ?>
            </p>
            <a href="<?php echo $_ENV['HOST']; ?>/productos/<?php echo $tipo; ?>" class="btn btn-primary"><i
                    class="bi bi-arrow-left me-2"></i>Volver a
                <?php echo $tipo; ?>
            </a>
        </div>
    </div>
</div>
<script src="<?php echo $_ENV['HOST']; ?>/build/js/pages/detalle.js"></script>