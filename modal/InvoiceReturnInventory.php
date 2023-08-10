<?php
require_once __DIR__.'/../util/initialize.php';

class InvoiceReturnInventory extends DatabaseObject{
    protected static $table_name="invoice_return_inventory";
    protected static $db_fields=array(); 
    protected static $db_fk=array("inventory_id"=>"Inventory","invoice_return_id"=>"InvoiceReturn","return_reason_id"=>"ReturnReason");
        
    public function inventory_id(){
        return parent::get_fk_object("inventory_id");
    }
    
    public function invoice_return_id(){
        return parent::get_fk_object("invoice_return_id");
    }
    
    public function return_reason_id(){
        return parent::get_fk_object("return_reason_id");
    }
    
    public static function find_all_by_invoice_return_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE invoice_return_id='$value'");
        return $object_array;
    }
}

?>