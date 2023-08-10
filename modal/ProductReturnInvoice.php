<?php
require_once  __DIR__."/../util/initialize.php";

class ProductReturnInvoice extends DatabaseObject{
    protected static $table_name="product_return_invoice";
    protected static $db_fields=array(); 
    protected static $db_fk = array("product_return_id" => "ProductReturn", "invoice_id" => "Invoice", "right_off" => "Invoice");

    public function product_return_id() {
        return parent::get_fk_object("product_return_id");
    }
    
    public function invoice_id() {
        return parent::get_fk_object("invoice_id");
    }

    public function right_off() {
        return parent::get_fk_object("right_off");
    }
    
    public static function find_by_product_return_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE product_return_id='$value'");
        return array_shift($object_array);
    }
    
    public static function find_all_by_product_return_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE product_return_id='$value'");
        return $object_array;
    }
    
    public static function find_by_invoice_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE invoice_id='$value'");
        return array_shift($object_array);
    }
    
    public static function find_all_by_invoice_id($value) {
        global $database;
        $value = $database->escape_value($value);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE invoice_id='$value'");
        return $object_array;
    }

}

?>