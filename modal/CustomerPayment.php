<?php
require_once __DIR__.'/../util/initialize.php';

class CustomerPayment extends DatabaseObject{
    protected static $table_name="customer_payment";
    protected static $db_fields=array(); 
    protected static $db_fk=array("customer_id"=>"Customer", "payment_id","Payment");
    
    public function customer_id(){
        return parent::get_fk_object("customer_id");
    }
    
    public function payment_id(){
        return parent::get_fk_object("payment_id");
    }
    
    public static function find_by_payment_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE payment_id='$value'");
        return array_shift($object_array);
    }
    
    public static function find_all_by_payment_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE payment_id='$value'");
        return $object_array;
    }
    
    public static function find_all_by_customer_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE customer_id='$value'");
        return $object_array;
    }
}