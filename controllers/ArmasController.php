<?php

namespace Controllers;

use Model\Weapon;


class ArmasController
{
    public static function buscar()
    {
        getHeadersApi();
        $weapon = new Weapon();
        $armas = $weapon->getAll();
        echo json_encode([
            'codigo' => 1,
            'mensaje' => 'Armas encontradas',
            'datos' => $armas
        ]);
    }
}