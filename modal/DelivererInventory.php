<?php
require_once __DIR__.'/../util/initialize.php';

class DelivererInventory extends DatabaseObject{
    protected static $table_name="deliverer_inventory";
    protected static $db_fields=array();
    protected static $db_fk=array("inventory_id"=>"Inventory", "deliverer_id"=>"Deliverer");

     public function inventory_id(){
        return parent::get_fk_object("inventory_id");
    }

    public function deliverer_id(){
        return parent::get_fk_object("deliverer_id");
    }

    public static function find_all_by_deliverer_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE deliverer_id='$value'");
        return $object_array;
    }



    public static function find_all_by_inventory_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE inventory_id='$value'");
        return $object_array;
    }

    public static function find_all_by_deliverer_id_inventory_id($value,$value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE deliverer_id='$value' AND inventory_id='$value1'");
        return $object_array;
    }

//    public static function find_all_by_inventory_id($value){
//        global $database;
//        $value=$database->escape_value($value);
//        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE inventory_id='$value'");
//        return $object_array;
//    }

    public static function find_by_deliverer_id_inventory_id($value,$value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE deliverer_id ='$value' AND inventory_id='$value1'");
        return array_shift($object_array);
    }

    public static function find_all_by_product_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." INNER JOIN inventory ON deliverer_inventory.inventory_id=inventory.id WHERE inventory.product_id ='$value'");
        return $object_array;
    }



    public static function find_all_by_deliverer_id_product_id($deliverer_id,$product_id){
        global $database;
        $deliverer_id=$database->escape_value($deliverer_id);
        $product_id=$database->escape_value($product_id);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." INNER JOIN inventory ON deliverer_inventory.inventory_id=inventory.id WHERE inventory.product_id ='$product_id' AND deliverer_inventory.deliverer_id='$deliverer_id'");
        return $object_array;
    }

    public static function find_all_by_deliverer_id_and_product_asc($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." INNER JOIN inventory ON deliverer_inventory.inventory_id=inventory.id INNER JOIN batch ON batch.id=inventory.batch_id INNER JOIN product ON product.id=batch.product_id WHERE deliverer_inventory.deliverer_id='$value' ORDER BY product.name ASC");
        return $object_array;
    }

    public static function find_all_by_deliverer_id_and_product_id_batch_asc($value,$value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT deliverer_inventory.* FROM deliverer_inventory INNER JOIN inventory ON deliverer_inventory.inventory_id=inventory.id INNER JOIN batch ON batch.id=inventory.batch_id INNER JOIN product ON product.id=batch.product_id WHERE deliverer_inventory.deliverer_id='$value' AND product.id='$value1' ORDER BY batch.code ASC");
        return $object_array;
    }

    public static function find_all_by_deliverer_id_product_id2($deliverer_id,$product_id){
        global $database;
        $deliverer_id=$database->escape_value($deliverer_id);
        $product_id=$database->escape_value($product_id);
        $object_array=self::find_by_sql("SELECT deliverer_inventory.id,deliverer_inventory.inventory_id,deliverer_inventory.qty,deliverer_inventory.deliverer_id FROM ".self::$table_name." LEFT JOIN inventory ON deliverer_inventory.inventory_id=inventory.id WHERE inventory.product_id ='$product_id' AND deliverer_inventory.deliverer_id='$deliverer_id'");
        return $object_array;
    }


}