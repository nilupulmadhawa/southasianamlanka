<?php
require_once  __DIR__.'/../util/initialize.php';

class StockAdj extends DatabaseObject{
    protected static $table_name="stock_adj";
    protected static $db_fields=array();
    protected static $db_fk=array("product_id"=>"Product","user_id"=>"User" );

    public function product_id() {
        return parent::get_fk_object("product_id");
    }

    public function user_id() {
        return parent::get_fk_object("user_id");
    }


    public static function find_all_by_date_range($value, $value1, $value3) {
        global $database;
        $value = $database->escape_value($value);
        $value1 = $database->escape_value($value1);
        $value3 = $database->escape_value($value3);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE product_id = '$value3' AND current_date_time BETWEEN '$value' AND '$value1'");
        return $object_array;
    }

    public static function find_all_by_date($value, $value3) {
        global $database;
        $value = $database->escape_value($value);
        $value3 = $database->escape_value($value3);
        $object_array = self::find_by_sql("SELECT * FROM " . self::$table_name . " WHERE product_id = '$value3' AND DATE(current_date_time) = '$value' ");
        return $object_array;
    }

}
