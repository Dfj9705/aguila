<?php

namespace Controllers;

use Exception;
use Model\Accessory;
use Model\Ammo;
use Model\Weapon;


class AccesoriosController
{
    public static function buscar()
    {
        getHeadersApi();
        $accesorio = new Accessory();
        try {
            $accesorios = $accesorio->getByFilters($_POST);
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Accesorios encontrados',
                'datos' => $accesorios,
                'request' => $_POST
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar municiones',
                'datos' => [],
                'request' => $_POST
            ]);
        }
    }
}