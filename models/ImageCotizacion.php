<?php

namespace Model;

class ImageCotizacion extends ActiveRecord
{
    protected static $tabla = 'cotizacion_imagenes';
    protected static $columnasDB = ['cotizacion_id', 'path', 'nombre_original', 'created_at'];

    protected static $idTabla = 'id';
    public $id;
    public $cotizacion_id;
    public $path;
    public $nombre_original;
    public $created_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->cotizacion_id = $args['cotizacion_id'] ?? null;
        $this->path = $args['path'] ?? null;
        $this->nombre_original = $args['nombre_original'] ?? null;
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
    }
}

