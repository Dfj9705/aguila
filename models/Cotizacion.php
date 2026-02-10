<?php

namespace Model;

class Cotizacion extends ActiveRecord
{
    protected static $tabla = 'cotizaciones';
    protected static $columnasDB = ['nombre', 'fecha', 'email', 'telefono', 'servicio', 'observaciones', 'estado', 'created_at', 'updated_at'];

    protected static $idTabla = 'id';
    public $id;
    public $nombre;
    public $fecha;
    public $email;
    public $telefono;
    public $servicio;
    public $observaciones;
    public $estado;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->fecha = $args['fecha'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->observaciones = $args['observaciones'] ?? '';
        $this->estado = $args['estado'] ?? 'nueva';
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    }
}
