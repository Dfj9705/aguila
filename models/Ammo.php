<?php

namespace Model;

use Exception;

class Ammo extends ActiveRecord
{
    protected static $tabla = 'ammos';
    protected static $columnasDB = ['brand_id', 'caliber_id', 'name', 'description', 'price_per_box', 'rounds_per_box', 'price', 'images', 'is_active', 'created_at', 'updated_at'];

    protected static $idTabla = 'id';
    public $id;
    public $brand_id;
    public $caliber_id;
    public $name;
    public $description;
    public $price_per_box;
    public $rounds_per_box;
    public $price;
    public $images;
    public $is_active;
    public $created_at;
    public $updated_at;

    public function __construct($args = [])
    {
        parent::__construct();
        $this->id = $args['id'] ?? null;
        $this->brand_id = $args['brand_id'] ?? null;
        $this->caliber_id = $args['caliber_id'] ?? null;
        $this->name = $args['name'] ?? null;
        $this->description = $args['description'] ?? null;
        $this->price_per_box = $args['price_per_box'] ?? null;
        $this->rounds_per_box = $args['rounds_per_box'] ?? null;
        $this->price = $args['price'] ?? null;
        $this->images = $args['images'] ?? null;
        $this->is_active = $args['is_active'] ?? 1;
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
    }

    public function getBrands()
    {
        try {
            $brands = $this->fetchArray("SELECT brands.id, brands.name FROM brands INNER JOIN ammos ON brands.id = ammos.brand_id WHERE ammos.is_active = 1 ORDER BY brands.name ASC");
            return $brands;
        } catch (Exception $e) {
            //throw $th;
            return [];
        }
    }

    public function getCalibers()
    {
        try {
            $calibers = $this->fetchArray("SELECT calibers.id, calibers.name FROM calibers INNER JOIN ammos ON calibers.id = ammos.caliber_id WHERE ammos.is_active = 1 ORDER BY calibers.name ASC");
            return $calibers;
        } catch (Exception $e) {
            //throw $th;
            return [];
        }
    }

    public function getByFilters($filters)
    {
        try {
            $where = "";
            if (!empty($filters['marcas'])) {
                $where .= " AND ammos.brand_id IN (" . implode(',', $filters['marcas']) . ")";
            }
            if (!empty($filters['calibres'])) {
                $where .= " AND ammos.caliber_id IN (" . implode(',', $filters['calibres']) . ")";
            }

            $query = "SELECT ammos.id, ammos.description, ammos.price_per_box, ammos.rounds_per_box, ammos.price, ammos.images, brands.name as brand, calibers.name as caliber
            FROM ammos inner join brands on ammos.brand_id = brands.id inner join calibers on ammos.caliber_id = calibers.id WHERE ammos.is_active = 1 " . $where;

            $municiones = $this->fetchArray($query);

            return $municiones;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAmmoById($id)
    {

        try {
            $query = "SELECT ammos.id, ammos.name, ammos.description, ammos.price_per_box, ammos.rounds_per_box, ammos.price, ammos.images, brands.name as brand, calibers.name as caliber,
            ((select sum(ammo_movements.boxes) from ammo_movements where ammo_movements.ammo_id = ammos.id and ammo_movements.type = 'IN')
            - (select sum(ammo_movements.boxes) from ammo_movements where ammo_movements.ammo_id = ammos.id and ammo_movements.type = 'OUT')) as stock
            FROM ammos inner join brands on ammos.brand_id = brands.id inner join calibers on ammos.caliber_id = calibers.id WHERE ammos.id = $id";

            $ammo = $this->fetchFirst($query);
            return $ammo;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}