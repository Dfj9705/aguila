<?php

namespace Controllers;

use Model\Accessory;
use Model\Ammo;
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
            case 'municiones':
                $ammo = new Ammo();
                $producto = $ammo->getAmmoById($id);
                break;
            case 'accesorios':
                $accesorio = new Accessory();
                $producto = $accesorio->getAccessoryById($id);
                break;

            default:
                break;
        }

        render('pages/detalle', [
            'producto' => $producto,
            'tipo' => $tipo
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
                render('pages/armas', [
                    'marcas' => $marcas,
                    'modelos' => $modelos,
                    'calibres' => $calibres,
                    'tipos_arma' => $tipos_arma,
                ]);
                break;
            case 'municiones':
                $ammo = new Ammo();
                $marcas = $ammo->getBrands();
                $calibres = $ammo->getCalibers();

                render('pages/municiones', [
                    'marcas' => $marcas,
                    'calibres' => $calibres,
                ]);
                break;
            case 'accesorios':
                $accesorio = new Accessory();
                $marcas = $accesorio->getBrands();
                $tipos = $accesorio->getTypes();
                $compatibles = $accesorio->getCompatibleBrandModels();
                render('pages/accesorios', [
                    'marcas' => $marcas,
                    'tipos' => $tipos,
                    'compatibles' => $compatibles,
                ]);
                break;
        }
    }



}