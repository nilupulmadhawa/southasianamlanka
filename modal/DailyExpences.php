<?php
require_once  __DIR__.'/../util/initialize.php';

class DailyExpences extends DatabaseObject{
    protected static $table_name="daily_expences";
    protected static $db_fields=array();
    protected static $db_fk=array("expence_cat"=>"ExpenceCat");

    public function expence_cat(){
        return parent::get_fk_object("expence_cat");
    }

    public static function find_all_desc() {
        global $database;
        $object_array = self::find_by_sql("SELECT * FROM ".self::$table_name." ORDER BY id DESC");
        return $object_array;
    }

}