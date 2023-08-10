<?php
require_once __DIR__.'/../util/initialize.php';

class PurchaseOrderProduct extends DatabaseObject{
    protected static $table_name="purchase_order_product";
    protected static $db_fields=array(); 
    protected static $db_fk=array("purchase_order_id"=>"PurchaseOrder","product_id"=>"Product");
    
//    public $id;
//    public $purchase_order_id;
//    public $product_id;
//    public $qty;
    
    public function purchase_order_id(){
        return parent::get_fk_object("purchase_order_id");
    }
    
    public function product_id(){
        return parent::get_fk_object("product_id");
    }
    
    public static function find_all_by_purchase_order_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE purchase_order_id='$value'");
        return $object_array;
    }
}

?>