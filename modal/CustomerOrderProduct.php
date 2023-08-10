<?php
require_once __DIR__.'/../util/initialize.php';

class CustomerOrderProduct extends DatabaseObject{
    protected static $table_name="customer_order_product";
    protected static $db_fields=array(); 
    protected static $db_fk=array("customer_order_id"=>"CustomerOrder","product_id"=>"Product");
    
//    public $id;
//    public $customer_order_id;
//    public $product_id;
//    public $qty;
        
    public function customer_order_id(){
        return parent::get_fk_object("customer_order_id");
    }
    
    public function product_id(){
        return parent::get_fk_object("product_id");
    }
    
    public static function find_all_by_customer_order_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE customer_order_id='$value'");
        return $object_array;
    }
    
    public static function find_all_by_product_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE product_id='$value'");
        return $object_array;
    }
    
}

?>