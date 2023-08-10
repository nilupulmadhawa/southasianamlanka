<?php
require_once __DIR__.'/../util/initialize.php';

class DelivererUser extends DatabaseObject{
    protected static $table_name="deliverer_user";
    protected static $db_fields=array(); 
    protected static $db_fk=array("user_id"=>"User", "deliverer_id"=>"Deliverer");
    
    public function user_id(){
        return parent::get_fk_object("user_id");
    } 
    
    public function deliverer_id(){
        return parent::get_fk_object("deliverer_id");
    } 
    
    public static function find_all_by_deliverer_id($value){
        global $database;
        $value=$database->escape_value($value);
        $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE deliverer_id='$value'");
        return $object_array;
    }
    
}

?>