<?php
require_once  __DIR__.'/../util/initialize.php';

class PaymentInvoice extends DatabaseObject{
    protected static $table_name="payment_invoice";
    protected static $db_fields=array();
    protected static $db_fk=array("invoice_id"=>"Invoice","payment_id"=>"Payment");


    public function invoice_id(){
        return parent::get_fk_object("invoice_id");
    }

    public function payment_id(){
        return parent::get_fk_object("payment_id");
    }

    public static function find_all_by_payment_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE payment_id='$value'");
        return $object_array;
    }

    public static function find_all_by_invoice_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE invoice_id='$value'");
        return $object_array;
    }

    public static function find_all_by_payment_id_invoice_id($value,$value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE payment_id='$value' AND invoice_id='$value1'");
        return $object_array;
    }

    public static function find_all_by_customer_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM payment_invoice LEFT JOIN invoice ON payment_invoice.invoice_id = invoice.id WHERE invoice.customer_id = '$value' ");
        return $object_array;
    }

    public static function find_by_payment_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE payment_id='$value'");
        return array_shift($object_array);
    }
}

?>
