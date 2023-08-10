<?php
require_once __DIR__.'/../util/initialize.php';

class GRNProduct extends DatabaseObject{
    protected static $table_name="grn_product";
    protected static $db_fields=array(); 
//    protected static $db_fk=array("grn_id"=>"GRN","product_id"=>"Product","batch_id"=>"Batch","user_id"=>"User");
    protected static $db_fk=array("grn_id"=>"GRN","product_id"=>"Product","batch_id"=>"Batch","user_id"=>"User");
    
//    public $id;
//    public $grn_id;
//    public $product_id;
//    public $batch_id;
//    public $qty;
//    public $user_id;
        
    public function grn_id(){
        return parent::get_fk_object("grn_id");
    }
    
//    public function product_id(){
//        return parent::get_fk_object("product_id");
//    }
    
    public function batch_id(){
        return parent::get_fk_object("batch_id");
    }
    
    public function user_id(){
        return parent::get_fk_object("user_id");
    }
    
    public static function find_all_by_grn_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE grn_id='$value'");
        return $object_array;
    }
    
//    public static function find_all_by_product_id($value){
//        global $database;
//        $value=$database->escape_value($value);
//        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE product_id='$value'");
//        return $object_array;
//    }
    public static function find_all_by_product_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " INNER JOIN batch ON batch.id=grn_product.batch_id WHERE batch.product_id ='$value'");
        return $object_array;
    }
    
    public static function find_all_by_batch_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE batch_id='$value'");
        return $object_array;
    }
    
    public static function find_by_batch_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE batch_id='$value'");
        return array_shift($object_array);
    }
}

?>