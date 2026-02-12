<?php

namespace Controllers;

use Exception;
use Model\Weapon;


class ArmasController
{
    public static function buscar()
    {
        getHeadersApi();
        $weapon = new Weapon();
        try {
            $armas = $weapon->getByFilters($_POST);
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Armas encontradas',
                'datos' => $armas,
                'request' => $_POST
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar armas',
                'datos' => [],
                'request' => $_POST
            ]);
        }
    }
}