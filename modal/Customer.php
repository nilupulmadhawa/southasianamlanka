<?php
require_once __DIR__.'/../util/initialize.php';

class Customer extends DatabaseObject{
  protected static $table_name="customer";
  protected static $db_fields=array();
  protected static $db_fk=array("route_id"=>"Route","status_by"=>"User");

  public function route_id(){
    return parent::get_fk_object("route_id");
  }

  public function status_by(){
    return parent::get_fk_object("status_by");
  }

  public static function getNextCode() {
    $auto_increment=parent::getAutoIncrement();
    return $auto_increment;
  }

  public static function find_all_asc(){
    global $database;
    $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." ORDER BY name ASC ");
    return $object_array;
  }

  public static function find_by_route_id($value){
    global $database;
    $value=$database->escape_value($value);
    $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE route_id='$value' ");
    return $object_array;
  }

  public static function find_all_has_balance(){
    $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE balance>0");
    return $object_array;
  }

  public static function find_all_rep_wise($value){
    global $database;
    $value=$database->escape_value($value);
    $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE allocated_rep = '$value' ");
    return $object_array;
  }
}

?>
