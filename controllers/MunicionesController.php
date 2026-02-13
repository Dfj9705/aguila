<?php

namespace Controllers;

use Exception;
use Model\Ammo;
use Model\Weapon;


class MunicionesController
{
    public static function buscar()
    {
        getHeadersApi();
        $ammo = new Ammo();
        try {
            $municiones = $ammo->getByFilters($_POST);
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Municiones encontradas',
                'datos' => $municiones,
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