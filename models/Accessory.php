<?php

namespace Model;

use Exception;

class Accessory extends ActiveRecord
{
    protected static $tabla = 'accessories';
    protected static $columnasDB = ['category_id', 'brand_id', 'name', 'sku', 'description', 'images', 'is_active', 'created_at', 'updated_at', 'unit_cost', 'unit_price', 'stock_min', 'created_by', 'updated_by', 'compatible_brand_model_id'];

    protected static $idTabla = 'id';
    public $id;
    public $category_id;
    public $brand_id;
    public $name;
    public $sku;
    public $description;
    public $images;
    public $unit_cost;
    public $unit_price;
    public $stock_min;
    public $is_active;
    public $created_at;
    public $updated_at;
    public $created_by;
    public $updated_by;
    public $compatible_brand_model_id;

    public function __construct($args = [])
    {
        parent::__construct();
        $this->id = $args['id'] ?? null;
        $this->category_id = $args['category_id'] ?? null;
        $this->brand_id = $args['brand_id'] ?? null;
        $this->name = $args['name'] ?? null;
        $this->sku = $args['sku'] ?? null;
        $this->description = $args['description'] ?? null;
        $this->images = $args['images'] ?? null;
        $this->unit_cost = $args['unit_cost'] ?? null;
        $this->unit_price = $args['unit_price'] ?? null;
        $this->stock_min = $args['stock_min'] ?? null;
        $this->is_active = $args['is_active'] ?? 1;
        $this->created_by = $args['created_by'] ?? null;
        $this->updated_by = $args['updated_by'] ?? null;
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->compatible_brand_model_id = $args['compatible_brand_model_id'] ?? null;
    }

    public function getBrands()
    {
        try {
            $brands = $this->fetchArray("SELECT brands.id, brands.name FROM brands INNER JOIN accessories ON brands.id = accessories.brand_id WHERE accessories.is_active = 1 ORDER BY brands.name ASC");
            return $brands;
        } catch (Exception $e) {
            //throw $th;
            error_log($e->getMessage());
            return [];
        }
    }

    public function getCompatibleBrandModels()
    {
        try {
            $calibers = $this->fetchArray("SELECT brand_models.id, brand_models.name as model, brands.name as brand FROM brand_models INNER JOIN accessories ON brand_models.id = accessories.compatible_brand_model_id inner join brands on brand_models.brand_id = brands.id WHERE accessories.is_active = 1 ORDER BY brand_models.name ASC");
            return $calibers;
        } catch (Exception $e) {
            //throw $th;
            error_log($e->getMessage());
            return [];
        }
    }

    public function getTypes()
    {
        try {
            $types = $this->fetchArray("SELECT accessory_categories.id, accessory_categories.name FROM accessory_categories INNER JOIN accessories ON accessory_categories.id = accessories.category_id WHERE accessories.is_active = 1 ORDER BY accessory_categories.name ASC");
            return $types;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return [];
        }
    }

    public function getByFilters($filters)
    {
        try {
            $where = "";
            if (!empty($filters['marcas'])) {
                $where .= " AND accessories.brand_id IN (" . implode(',', $filters['marcas']) . ")";
            }
            if (!empty($filters['compatibles'])) {
                $where .= " AND accessories.compatible_brand_model_id IN (" . implode(',', $filters['compatibles']) . ") OR accessories.compatible_brand_model_id IS NULL";
            }
            if (!empty($filters['tipos'])) {
                $where .= " AND accessories.category_id IN (" . implode(',', $filters['tipos']) . ")";
            }

            $query = "SELECT accessories.id, accessories.name, accessories.description, accessories.unit_price, accessories.stock_min, accessories.images, b1.name as brand, b2.name as compatible_brand, brand_models.name as compatible_model
            FROM accessories inner join brands b1 on accessories.brand_id = b1.id left join brand_models on brand_models.id = accessories.compatible_brand_model_id left join brands b2 on brand_models.brand_id = b2.id WHERE accessories.is_active = 1 " . $where;

            $accesorios = $this->fetchArray($query);

            return $accesorios;
        } catch (Exception $e) {
            error_log($e->getMessage());
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
            error_log($e->getMessage());
            throw new Exception($e->getMessage());
        }
    }
}