<?php
require_once __DIR__.'/../util/initialize.php';

class InvoiceReturn extends DatabaseObject{
    protected static $table_name="invoice_return";
    protected static $db_fields=array(); 
    protected static $db_fk=array("invoice_id"=>"Invoice","user_id"=>"User","deliverer_id"=>"Deliverer");
    
    public function invoice_id(){
        return parent::get_fk_object("invoice_id");
    }
    
    public function user_id(){
        return parent::get_fk_object("user_id");
    }
    
    public function deliverer_id(){
        return parent::get_fk_object("deliverer_id");
    }
            
    public static function getNextCode() {
        $auto_increment=parent::getAutoIncrement();
        return $auto_increment;
    }  
    
    public static function find_all_by_invoice_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE invoice_id='$value'");
        return $object_array;
    }
}

?>