<?php
require_once __DIR__.'/../util/initialize.php';

class PurchaseOrder extends DatabaseObject{
    protected static $table_name="purchase_order";
    protected static $db_fields=array(); 
    protected static $db_fk=array("supplier_id"=>"Supplier","purchase_order_type_id"=>"PurchaseOrderType","user_id"=>"User", "purchase_order_status_id"=>"PurchaseOrderStatus");
    
//    public $id;
//    public $code;
//    public $date;
//    public $supplier_id;
//    public $purchase_order_type_id;
//    public $user_id;
//    public $purchase_order_status_id;
    
    public function supplier_id(){
        return parent::get_fk_object("supplier_id");
    }
    
    public function purchase_order_type_id(){
        return parent::get_fk_object("purchase_order_type_id");
    }
    
    public function user_id(){
        return parent::get_fk_object("user_id");
    }
    
    public function purchase_order_status_id(){
        return parent::get_fk_object("purchase_order_status_id");
    }
    
    
    public static function getNextCode() {
        $auto_increment=parent::getAutoIncrement();
        return $auto_increment;
    }  
    
    public static function find_all_by_purchase_order_type_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE purchase_order_type_id='$value'");
        return $object_array;
    }
}

?>