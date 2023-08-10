<?php
require_once  __DIR__.'/../util/initialize.php';

class PaymentCheque extends DatabaseObject{
    protected static $table_name="payment_cheque";
    protected static $db_fields=array();
    protected static $db_fk=array("payment_id"=>"Payment","cheque_id"=>"Cheque");

     public function payment_id(){
        return parent::get_fk_object("payment_id");
    }

     public function cheque_id(){
        return parent::get_fk_object("cheque_id");
    }

    public static function find_by_payment_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE payment_id='$value'");
        return array_shift($object_array);
    }

    public static function find_all_by_payment_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE payment_id='$value'");
        return $object_array;
    }

    public static function find_all_by_cheque_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE cheque_id='$value'");
        return $object_array;
    }

    public static function find_all_by_payment_id_cheque_id($value, $value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE payment_id='$value' AND cheque_id='$value1'");
        return $object_array;
    }

    public static function find_by_payment_cheque_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE cheque_id='$value' ORDER BY id ASC LIMIT 1");
        return array_shift($object_array);
    }

}

?>
