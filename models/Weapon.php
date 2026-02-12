<?php

namespace Model;

use Exception;

class Weapon extends ActiveRecord
{
    protected static $tabla = 'weapons';
    protected static $columnasDB = ['barrel_length_mm', 'brand_id', 'brand_model_id', 'caliber_id', 'created_at', 'description', 'images', 'magazine_capacity', 'price', 'status', 'updated_at', 'weapon_type_id'];

    protected static $idTabla = 'id';
    public $id;
    public $barrel_length_mm;
    public $brand_id;
    public $brand_model_id;
    public $caliber_id;
    public $created_at;
    public $description;
    public $images;
    public $magazine_capacity;
    public $price;
    public $status;
    public $updated_at;
    public $weapon_type_id;

    public function __construct($args = [])
    {
        parent::__construct();
        $this->id = $args['id'] ?? null;
        $this->barrel_length_mm = $args['barrel_length_mm'] ?? null;
        $this->brand_id = $args['brand_id'] ?? null;
        $this->brand_model_id = $args['brand_model_id'] ?? null;
        $this->caliber_id = $args['caliber_id'] ?? null;
        $this->created_at = $args['created_at'] ?? date('Y-m-d H:i:s');
        $this->description = $args['description'] ?? null;
        $this->images = $args['images'] ?? null;
        $this->magazine_capacity = $args['magazine_capacity'] ?? null;
        $this->price = $args['price'] ?? null;
        $this->status = $args['status'] ?? 'ACTIVE';
        $this->updated_at = $args['updated_at'] ?? date('Y-m-d H:i:s');
        $this->weapon_type_id = $args['weapon_type_id'] ?? null;
    }

    public function getWeapons()
    {
        try {
            $anuncios = $this->fetchArray("SELECT * FROM " . self::$tabla . " WHERE status = 'ACTIVE' ORDER BY id ASC");
            return $anuncios;
        } catch (Exception $e) {
            //throw $th;
            return [];
        }
    }
    public function getBrands()
    {
        try {
            $brands = $this->fetchArray("SELECT * FROM brands INNER JOIN weapons ON brands.id = weapons.brand_id WHERE weapons.status = 'ACTIVE' ORDER BY brands.name ASC");
            return $brands;
        } catch (Exception $e) {
            //throw $th;
            return [];
        }
    }
    public function getModels()
    {
        try {
            $models = $this->fetchArray("SELECT * FROM brand_models INNER JOIN weapons ON brand_models.id = weapons.brand_model_id WHERE weapons.status = 'ACTIVE' ORDER BY brand_models.name ASC");
            return $models;
        } catch (Exception $e) {
            //throw $th;
            return [];
        }
    }
    public function getCalibers()
    {
        try {
            $calibers = $this->fetchArray("SELECT * FROM calibers INNER JOIN weapons ON calibers.id = weapons.caliber_id WHERE weapons.status = 'ACTIVE' ORDER BY calibers.name ASC");
            return $calibers;
        } catch (Exception $e) {
            //throw $th;
            return [];
        }
    }
    public function getWeaponTypes()
    {
        try {
            $weaponTypes = $this->fetchArray("SELECT * FROM weapon_types INNER JOIN weapons ON weapon_types.id = weapons.weapon_type_id WHERE weapons.status = 'ACTIVE' ORDER BY weapon_types.name ASC");
            return $weaponTypes;
        } catch (Exception $e) {
            //throw $th;
            return [];
        }
    }

    public function getMinMaxPrice()
    {
        try {
            $minMaxPrice = $this->fetchFirst("SELECT MIN(price) as min, MAX(price) as max FROM weapons WHERE status = 'ACTIVE'");
            return $minMaxPrice;
        } catch (Exception $e) {
            //throw $th;
            return [];
        }
    }

    public function getAll()
    {
        try {
            $weapons = $this->fetchArray("SELECT weapons.id, weapons.description, weapons.price, weapons.images, weapons.status, brands.name as brand, brand_models.name as model, calibers.name as caliber, weapon_types.name as weapon_type FROM weapons inner join brands on weapons.brand_id = brands.id inner join brand_models on weapons.brand_model_id = brand_models.id inner join calibers on weapons.caliber_id = calibers.id inner join weapon_types on weapons.weapon_type_id = weapon_types.id WHERE weapons.status = 'ACTIVE'");
            return $weapons;
        } catch (Exception $e) {
            //throw $th;
            return [];
        }
    }
}

