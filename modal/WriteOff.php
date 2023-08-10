<?php

require_once __DIR__ . '/../util/initialize.php';

class WriteOff extends DatabaseObject {

  protected static $table_name = "write_off";
  protected static $db_fields = array();
  protected static $db_fk = array("invoice_id" => "Invoice");

  public function invoice_id() {
    return parent::get_fk_object("invoice_id");
  }

  public static function find_all_by_invoice_id($value){
      global $database;
      $value=$database->escape_value($value);
      $object_array=self::find_by_sql("SELECT * FROM ".self::$table_name." WHERE invoice_id='$value'");
      return $object_array;
  }


}

?>
