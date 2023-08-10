<?php
require_once  __DIR__.'/../util/initialize.php';

class SalaryPayment extends DatabaseObject{
    protected static $table_name="emp_salary";
    protected static $db_fields=array();
    protected static $db_fk = array("emp_id"=>"User");

    public function emp_id(){
        return parent::get_fk_object("emp_id");
    }

    public static function find_all_desc() {
        global $database;
        $object_array = self::find_by_sql("SELECT * FROM ".self::$table_name." ORDER BY id DESC");
        return $object_array;
    }

}