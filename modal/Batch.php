<?php

require_once __DIR__ . '/../util/initialize.php';

class Batch extends DatabaseObject {

    protected static $table_name = "batch";
    protected static $db_fields = array();
    protected static $db_fk = array("product_id"=>"Product");

    public function product_id(){
        return parent::get_fk_object("product_id");
    }

    public static function getNextCode() {
        $auto_increment = parent::getAutoIncrement();
        return $auto_increment;
    }

    public static function find_all_by_product_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE product_id='$value'");
        return $object_array;
    }

    public static function find_all_by_product_id_last($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE product_id='$value' ORDER BY id DESC LIMIT 1 ");
        return $object_array;
    }

    public static function find_dollar_rate($value) {
        global $database;
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE product_id='$value' ORDER BY id DESC LIMIT 1");
        return array_shift($object_array);
    }

    public static function find_by_product_id_last($value) {
        global $database;
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE product_id='$value' ORDER BY id DESC LIMIT 1");
        return array_shift($object_array);
    }

    public static function find_by_product_id_first($value) {
        global $database;
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE product_id='$value' ORDER BY id ASC LIMIT 1");
        return array_shift($object_array);
    }


    public static function find_by_inventory_id($inventory_id) {
        $inventory= Inventory::find_by_id($inventory_id);

        $batch = new Batch();
        if ($inventory->inventory_type_id == 1) {
            $inventory_grn_product = InventoryGRNProduct::find_by_inventory_id($inventory->id);
            $batch = $inventory_grn_product->grn_product_id()->batch_id();
        } else if ($inventory->inventory_type_id == 2) {
            $inventory_production_product = InventoryProductionProduct::find_by_inventory_id($inventory->id);
            $batch = $inventory_production_product->production_product_id()->batch_id();
        }

        return $batch;
    }

    public static function find_all_by_name_asc() {
        $object_array=self::find_by_sql("SELECT * FROM batch ORDER BY code ASC");
        return $object_array;
    }

}
