<?php

namespace Model;

class MontajeServicio extends ActiveRecord
{
    protected static $tabla = 'montaje_servicios';
    protected static $columnasDB = ['titulo', 'tipo_servicio_id', 'descripcion', 'fotos', 'activo', 'created_at', 'updated_at'];

    protected static $idTabla = 'id';
    public $id;
    public $titulo;
    public $tipo_servicio_id;
    public $descripcion;
    public $fotos;
    public $activo;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? null;
        $this->tipo_servicio_id = $args['tipo_servicio_id'] ?? null;
        $this->descripcion = $args['descripcion'] ?? null;
        $this->fotos = $args['fotos'] ?? null;
        $this->activo = $args['activo'] ?? null;
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    }

}

