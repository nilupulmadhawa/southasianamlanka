<?php
require_once __DIR__.'/../util/initialize.php';

class StockMovement extends DatabaseObject{

    protected static $table_name="stock_movement";
    protected static $db_fields=array();
    protected static $db_fk=array();

    // functions start

    public static function find_by_item_date($value,$value1,$value2){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $value2=$database->escape_value($value2);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE item_id='$value' AND DATE(operated_id) BETWEEN '$value1' AND '$value2' ORDER BY id ASC ");
        return $object_array;
    }
}

?>
