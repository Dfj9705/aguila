<?php

namespace Model;

class Anuncio extends ActiveRecord
{
    protected static $tabla = 'anuncios';
    protected static $columnasDB = ['titulo', 'subtitulo', 'imagen', 'orden', 'activo', 'created_at', 'updated_at'];

    protected static $idTabla = 'id';
    public $id;
    public $titulo;
    public $subtitulo;
    public $imagen;
    public $orden;
    public $activo;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? null;
        $this->subtitulo = $args['subtitulo'] ?? null;
        $this->imagen = $args['imagen'] ?? null;
        $this->orden = $args['orden'] ?? null;
        $this->activo = $args['activo'] ?? null;
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    }

    public static function getAnuncionOrder()
    {
        $anuncios = self::fetchArray("SELECT * FROM " . static::$tabla . " WHERE activo = 1 ORDER BY orden ASC");
        return $anuncios;
    }
}

