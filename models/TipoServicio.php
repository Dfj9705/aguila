<?php

namespace Model;

class TipoServicio extends ActiveRecord
{
    protected static $tabla = 'tipo_servicios';
    protected static $columnasDB = ['nombre', 'descripcion', 'activo', 'created_at', 'updated_at'];

    protected static $idTabla = 'id';
    public $id;
    public $nombre;
    public $descripcion;
    public $activo;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? null;
        $this->descripcion = $args['descripcion'] ?? null;
        $this->activo = $args['activo'] ?? null;
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    }
}

