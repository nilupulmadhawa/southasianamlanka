<?php
require_once __DIR__.'/../util/initialize.php';

class PurchaseOrderMaterial extends DatabaseObject{
    protected static $table_name="purchase_order_material";
    protected static $db_fields=array(); 
    protected static $db_fk=array("purchase_order_id"=>"PurchaseOrder","material_id"=>"material");
    
//    public $id;
//    public $purchase_order_id;
//    public $material_id;
//    public $volume;
    
    public function purchase_order_id(){
        return parent::get_fk_object("purchase_order_id");
    }
    
    public function material_id(){
        return parent::get_fk_object("material_id");
    }
    
    public static function find_all_by_purchase_order_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE purchase_order_id='$value'");
        return $object_array;
    }
    
    public static function find_all_by_material_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE material_id='$value'");
        return $object_array;
    }
    
}

?>