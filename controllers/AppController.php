<?php

namespace Controllers;

use Model\Anuncio;
use Model\MontajeServicio;
use Model\TipoServicio;
use MVC\Router;

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
    public static function detalle($id)
    {
        render('pages/detalle', []);
    }

    public static function tiposProductos($tipo)
    {
        echo $tipo;
        // render('pages/tipos-productos', []);
    }



}