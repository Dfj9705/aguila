<?php

namespace Controllers;

use Model\Weapon;


class AppController
{
    public static function index()
    {
        render('pages/home', []);
    }
    public static function somos()
    {
        render('pages/quienes-somos', []);
    }
    public static function mision()
    {
        render('pages/mision-vision', []);
    }
    public static function productos()
    {
        render('pages/productos', []);
    }
    public static function contacto()
    {
        render('pages/contacto', []);
    }
    public static function detalle($tipo, $id)
    {

        $producto = null;
        switch ($tipo) {
            case 'armas':
                $arma = new Weapon();
                $producto = $arma->getWeaponById($id);
                break;

            default:
                break;
        }

        render('pages/detalle', [
            'producto' => $producto
        ]);
    }

    public static function tiposProductos($tipo)
    {
        switch ($tipo) {
            case 'armas':
                $weapon = new Weapon();
                $marcas = $weapon->getBrands();
                $modelos = $weapon->getModels();
                $calibres = $weapon->getCalibers();
                $tipos_arma = $weapon->getWeaponTypes();
                $minMaxPrice = $weapon->getMinMaxPrice();
                render('pages/armas', [
                    'marcas' => $marcas,
                    'modelos' => $modelos,
                    'calibres' => $calibres,
                    'tipos_arma' => $tipos_arma,
                    'minMaxPrice' => $minMaxPrice
                ]);
                break;
            case 'municiones':
                render('pages/municiones', []);
                break;
            case 'accesorios':
                render('pages/accesorios', []);
                break;
        }
    }



}