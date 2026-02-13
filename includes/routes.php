<?php
require_once __DIR__ . '/../includes/app.php';

use Bramus\Router\Router;
use Controllers\AccesoriosController;
use Controllers\AppController;
use Controllers\ArmasController;
use Controllers\ContactoController;
use Controllers\CotizadorController;
use Controllers\MunicionesController;

$router = new Router();

$router->setBasePath('/');

// 404
$router->set404(function () {
    http_response_code(404);

    // si es AJAX/API
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        getHeadersApi();
        echo json_encode(["ERROR" => "PÁGINA NO ENCONTRADA"]);
        return;
    }

    // si es vista normal, render como hacías (podés usar tu Router MVC o un helper)
    // O si tienes una función global:
    render('pages/notfound'); // ajusta a tu forma real de renderizar
});

// Rutas GET
$router->get('/', [AppController::class, 'index']);
$router->get('/quienes-somos', [AppController::class, 'somos']);
$router->get('/mision-vision', [AppController::class, 'mision']);
$router->get('/productos', [AppController::class, 'productos']);
$router->get('/contacto', [AppController::class, 'contacto']);
$router->get('/detalle/{$tipo}/{$id}', [AppController::class, 'detalle']);
$router->get('/productos/{tipo}', [AppController::class, 'tiposProductos']);
$router->get('/detalle/accesorios/{$id}', [AppController::class, 'detalleAccesorio']);

// API agrupada
$router->mount('/API', function () use ($router) {
    $router->post('/contacto/enviar', fn() => ContactoController::enviar());
    $router->post('/armas/buscar', fn() => ArmasController::buscar());
    $router->post('/accesorios/buscar', fn() => AccesoriosController::buscar());
    $router->post('/municiones/buscar', fn() => MunicionesController::buscar());
});

// Ejecutar
$router->run();