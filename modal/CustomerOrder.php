<?php
require_once __DIR__.'/../util/initialize.php';

class CustomerOrder extends DatabaseObject{
    protected static $table_name="customer_order";
    protected static $db_fields=array(); 
    protected static $db_fk=array("customer_order_status_id"=>"CustomerOrderStatus", "customer_id"=>"Customer", "user_id"=>"User");
    
//    public $id;
//    public $code;
//    public $date_time;
//    public $customer_order_status_id;
//    public $customer_id;
//    public $user_id;
    
    public function customer_order_status_id(){
        return parent::get_fk_object("customer_order_status_id");
    }
    
    public function customer_id(){
        return parent::get_fk_object("customer_id");
    }
    
    public function user_id(){
        return parent::get_fk_object("user_id");
    }
    
    public static function getNextCode() {
        $auto_increment=parent::getAutoIncrement();
        return $auto_increment;
    }  
    
    public static function find_all_by_customer_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE customer_id='$value'");
        return $object_array;
    }
    
}

?>