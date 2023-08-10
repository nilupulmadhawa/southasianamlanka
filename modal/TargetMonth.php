<?php
require_once __DIR__.'/../util/initialize.php';

class TargetMonth extends DatabaseObject{
    protected static $table_name="target_month";
    protected static $db_fields=array(); 
    protected static $db_fk=array();
    
    public static function get_month_name_by_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT name FROM ".self::$table_name." WHERE id='$value'");
        return array_shift($object_array);
    }
    
}

?>