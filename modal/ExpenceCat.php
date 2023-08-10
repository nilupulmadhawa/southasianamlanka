<?php
require_once  __DIR__.'/../util/initialize.php';

class ExpenceCat extends DatabaseObject{
    protected static $table_name="expence_cat";
    protected static $db_fields=array();
    protected static $db_fk=array();

    public static function find_all_desc() {
        global $database;
        $object_array = self::find_by_sql("SELECT * FROM ".self::$table_name." ORDER BY id DESC");
        return $object_array;
    }

}