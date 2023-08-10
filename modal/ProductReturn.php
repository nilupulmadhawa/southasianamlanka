<?php
require_once __DIR__.'/../util/initialize.php';

class ProductReturn extends DatabaseObject{
    protected static $table_name="product_return";
    protected static $db_fields=array();
    protected static $db_fk=array("user_id"=>"User","deliverer_id"=>"Deliverer","customer_id"=>"Customer","invoice_id"=>"Invoice","approved_by"=>"User");

//    id, date_time, note, user_id, deliverer_id

    public function user_id(){
        return parent::get_fk_object("user_id");
    }

    public function deliverer_id(){
        return parent::get_fk_object("deliverer_id");
    }

    public function customer_id(){
        return parent::get_fk_object("customer_id");
    }

    public function invoice_id(){
        return parent::get_fk_object("invoice_id");
    }

    public function approved_by(){
        return parent::get_fk_object("approved_by");
    }

    public static function find_all_by_date_range_product($value,$value1,$value2){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        // $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE date_time BETWEEN '$value' AND '$value1'");
        $object_array=self::find_by_sql("SELECT product_return.id from product_return, product_return_batch, batch WHERE product_return.id = product_return_batch.product_return_id AND product_return_batch.batch_id = batch.id AND batch.product_id = '$value2' AND product_return.date_time BETWEEN '$value' AND '$value1' ");
        return $object_array;
    }

    public static function find_latest(){
        global $database;
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE 1 ORDER BY id DESC LIMIT 100");
        return $object_array;
    }

    public static function find_all_by_date_range($value,$value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE date_time BETWEEN '$value' AND '$value1'");
        return $object_array;
    }

    public static function find_all_dates($value, $value2){
        global $database;
        $value=$database->escape_value($value);
        $value=$database->escape_value($value2);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE deliverer_id  = '$value2' ");
        return $object_array;
    }

    public static function find_all_date($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE DATE(date_time) = '$value' ");
        return $object_array;
    }

    public static function find_all_month($value,$value2){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE MONTH(date_time) = '$value' AND YEAR(date_time) = '$value2' ");
        return $object_array;
    }

    public static function find_all_dates_all(){
        global $database;
        // $value=$database->escape_value($value2);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name);
        return $object_array;
    }



    public static function find_all_by_product_id_date_range($product_id,$from,$to){
        global $database;
        $product_id=$database->escape_value($product_id);
        $from=$database->escape_value($from);
        $to=$database->escape_value($to);
        $object_array=self::find_by_sql("SELECT product_return.* FROM ".self::$table_name." INNER JOIN product_return_batch AS prb ON prb.product_return_id=product_return.id INNER JOIN batch ON prb.batch_id=batch.id WHERE batch.product_id='$product_id' AND product_return.date_time BETWEEN '$from' AND '$to' ORDER BY product_return.date_time ASC");
        return $object_array;
    }

    public static function find_all_by_product_id_date($product_id,$from){
        global $database;
        $product_id=$database->escape_value($product_id);
        $from=$database->escape_value($from);
        $object_array=self::find_by_sql("SELECT product_return.* FROM ".self::$table_name." INNER JOIN product_return_batch AS prb ON prb.product_return_id=product_return.id INNER JOIN batch ON prb.batch_id=batch.id WHERE batch.product_id='$product_id' AND DATE(product_return.date_time) = '$from' ORDER BY product_return.date_time ASC");
        return $object_array;
    }

    public static function find_all_by_month($value){
        global $database;
        $value=$database->escape_value($value);
        $year=date("Y");
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE YEAR(date_time) = '$year' AND MONTH(date_time) = '$value' ;");
        return $object_array;
    }

    public static function find_all_by_invoice_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE invoice_id='$value' ");
        return $object_array;
    }

}
