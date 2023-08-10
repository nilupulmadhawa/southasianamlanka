<?php
require_once __DIR__.'/../util/initialize.php';

class Product extends DatabaseObject{
    protected static $table_name="product";
    protected static $db_fields=array();
    protected static $db_fk=array("category_id"=>"Category","brand"=>"Brand","unit_model"=>"Unit");

//    public $id;
//    public $name;
//    public $category_id;
//    public $roq;
//    public $max_qty;
//    public $min_qty;
//    public $retail_price;
//    public $wholesale_price;
//    public $cost;

    public function category_id(){
        return parent::get_fk_object("category_id");
    }
    public function brand(){
        return parent::get_fk_object("brand");
    }
    public function unit_model(){
        return parent::get_fk_object("unit_model");
    }


    public static function find_all_brand_wise(){
        global $database;
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." ORDER BY brand ASC");
        return $object_array;
    }


    public static function find_by_brand($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT DISTINCT * FROM ".self::$table_name." WHERE brand = '$value' ORDER BY brand ASC ");
        return $object_array;
    }

    public static function find_all_by_category_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE category_id='$value'");
        return array_shift($object_array);
    }

    public static function find_all_by_distinct_brand(){
        global $database;
        $object_array=self::find_by_sql("SELECT DISTINCT brand FROM ".self::$table_name." ORDER BY brand ASC ");
        return $object_array;
    }

    public static function find_all_by_brand($value){
        global $database;
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE brand = '$value' ORDER BY name ASC");
        return $object_array;
    }

    public static function find_all_by_order_by_name(){
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." ORDER BY name ASC");
        return $object_array;
    }

    public static function find_all_by_deliverer_inventory_id_order_by_product_name($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT product.* FROM product INNER JOIN batch ON product.id=batch.product_id INNER JOIN inventory ON batch.id=inventory.batch_id INNER JOIN deliverer_inventory ON inventory.id=deliverer_inventory.inventory_id WHERE deliverer_inventory.deliverer_id='$value' ORDER BY product.name ASC");
        return $object_array;
    }

    public static function find_all_by_category($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE category_id='$value'");
        return $object_array;
    }
}
