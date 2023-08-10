<?php
require_once __DIR__.'/../util/initialize.php';

class ProductReturnBatch extends DatabaseObject{
    protected static $table_name="product_return_batch";
    protected static $db_fields=array();
    protected static $db_fk=array("product_return_id"=>"ProductReturn","batch_id"=>"Batch","return_reason_id"=>"ReturnReason");

//    id, product_return_id, batch_id, return_reason_id, qty, unit_price

    public function product_return_id(){
        return parent::get_fk_object("product_return_id");
    }

    public function batch_id(){
        return parent::get_fk_object("batch_id");
    }

    public function return_reason_id(){
        return parent::get_fk_object("return_reason_id");
    }

    public static function find_all_by_product_return_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE product_return_id='$value'");
        return $object_array;
    }

    public static function find_all_damage(){
        global $database;
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE return_reason_id = 3 ");
        return $object_array;
    }

}

?>
