<?php
require_once __DIR__.'/../util/initialize.php';

class Target extends DatabaseObject{
    protected static $table_name="target";
    protected static $db_fields=array(); 
    protected static $db_fk=array("target_month_id"=>"TargetMonth","user_id"=>"User");
    
   
    public function target_month_id(){
        return parent::get_fk_object("target_month_id");
    }
    
    public function user_id(){
        return parent::get_fk_object("user_id");
    }
    
    public static function find_targets_by_year_and_month($value,$value1){
        global $database;
        $value=$database->escape_value($value);
        $value1=$database->escape_value($value1);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE target_month_id=$value AND year='$value1'");
        return $object_array;
    } 

    
}

?>