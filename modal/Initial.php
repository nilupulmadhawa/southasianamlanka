<?php

require_once __DIR__ . '/../util/initialize.php';

class Initial extends DatabaseObject {

    protected static $table_name = "inial";
    protected static $db_fields = array();
    protected static $db_fk = array("product_id "=>"Product", "batch_id"=>"Batch");

    public function product_id(){
        return parent::get_fk_object("product_id");
    }

    public function batch_id(){
        return parent::get_fk_object("batch_id");
    }

    public static function getNextCode() {
        $auto_increment = parent::getAutoIncrement();
        return $auto_increment;
    }


    public static function find_by_product_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE product_id='$value'");
        return array_shift($object_array);
    }


}
